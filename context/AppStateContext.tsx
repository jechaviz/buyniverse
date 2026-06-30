import React, { createContext, useReducer, useContext, useEffect, useRef, ReactNode, Dispatch } from 'react';
import { AppState, Action } from '@/types';
import { initialState } from '@/store/initialState';
import { appReducer } from '@/store/reducer';

const AppStateContext = createContext<{ state: AppState; dispatch: Dispatch<Action> } | undefined>(undefined);

// Bump this whenever the shape of AppState/seed data changes in a way that makes
// previously persisted state incompatible. A mismatch discards the stored state
// and falls back to the seed data.
const STORAGE_VERSION = 1;
const STORAGE_KEY = `buyniverse-state:v${STORAGE_VERSION}`;

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
    useEffect(() => {
        if (persistTimer.current) clearTimeout(persistTimer.current);
        persistTimer.current = setTimeout(() => {
            try {
                localStorage.setItem(STORAGE_KEY, JSON.stringify(state));
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
