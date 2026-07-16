import React, { createContext, useReducer, useContext, useEffect, useRef, ReactNode, Dispatch } from 'react';
import { AppState, Action } from '@/types';
import { initialState } from '@/store/initialState';
import { appReducer } from '@/store/reducer';

const AppStateContext = createContext<{ state: AppState; dispatch: Dispatch<Action> } | undefined>(undefined);

// Bump this whenever the shape of AppState/seed data changes in a way that makes
// previously persisted state incompatible. A mismatch discards the stored state
// and falls back to the seed data.
const STORAGE_VERSION = 2;
const STORAGE_KEY = `buyniverse-state:v${STORAGE_VERSION}`;

// Field names that hold Issuer / PAC credentials or any other secret. These must
// NEVER be written to localStorage (it is readable by any script on the page and
// persists on disk). We strip them at serialization time only; the in-memory state
// shape is left untouched so the app keeps working during the session.
const EXPLICIT_SECRET_KEYS = new Set<string>([
    'csdPassword',
    'csdKey',
    'csdCert',
    'pacApiKey',
    'pacUser',
]);

// Heuristic match for any other secret-looking field (case-insensitive substring).
const SECRET_KEY_PATTERN = /password|apikey|secret|cert|key/i;

const isSecretKey = (key: string): boolean =>
    EXPLICIT_SECRET_KEYS.has(key) || SECRET_KEY_PATTERN.test(key);

// JSON.stringify replacer that omits secret fields from the persisted payload.
// Returning `undefined` for a property drops it from the serialized object.
const secretsReplacer = (key: string, value: unknown): unknown =>
    isSecretKey(key) ? undefined : value;

const loadPersistedState = (): AppState => {
    try {
        const raw = localStorage.getItem(STORAGE_KEY);
        if (!raw) return initialState;
        const parsed = JSON.parse(raw);
        // Minimal sanity check: must look like our state.
        if (parsed && typeof parsed === 'object' && Array.isArray(parsed.jobs) && parsed.currentUser) {
            return parsed as AppState;
        }
    } catch {
        // Corrupt or incompatible payload — fall back to seed data.
    }
    return initialState;
};

export const AppStateProvider: React.FC<{ children: ReactNode }> = ({ children }) => {
    const [state, dispatch] = useReducer(appReducer, undefined, loadPersistedState);
    const persistTimer = useRef<ReturnType<typeof setTimeout> | null>(null);

    // Persist state to localStorage, debounced to avoid thrashing on rapid dispatches.
    // NOTE on user-change: the persisted blob is keyed only by STORAGE_VERSION, not by
    // the logged-in user. Because secrets are never written (see secretsReplacer), there
    // is no credential leakage across users. If multi-user secret isolation is ever
    // required, namespace STORAGE_KEY by `state.currentUser?.id` and call
    // localStorage.removeItem on the previous user's key when currentUser changes.
    useEffect(() => {
        if (persistTimer.current) clearTimeout(persistTimer.current);
        persistTimer.current = setTimeout(() => {
            try {
                // Strip secret credentials (CSD/PAC keys, passwords, certs) so they
                // never touch localStorage. Note: on the next page load these fields
                // come back as `undefined` in the rehydrated state — they must be
                // re-entered by the user, which is the intended secure behavior.
                localStorage.setItem(STORAGE_KEY, JSON.stringify(state, secretsReplacer));
            } catch {
                // Quota exceeded or serialization issue — ignore; app stays usable in-memory.
            }
        }, 300);
        return () => {
            if (persistTimer.current) clearTimeout(persistTimer.current);
        };
    }, [state]);

    return (
        <AppStateContext.Provider value={{ state, dispatch }}>
            {children}
        </AppStateContext.Provider>
    );
};

export const useAppState = (): AppState => {
    const context = useContext(AppStateContext);
    if (!context) {
        throw new Error('useAppState must be used within an AppStateProvider');
    }
    return context.state;
};

export const useAppDispatch = (): Dispatch<Action> => {
    const context = useContext(AppStateContext);
    if (!context) {
        throw new Error('useAppDispatch must be used within an AppStateProvider');
    }
    return context.dispatch;
};
