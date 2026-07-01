
const ALLOWED_PROTOCOLS = ['http:', 'https:', 'mailto:'];

/**
 * Returns the given URL only if its protocol is in the allowlist
 * (http, https, mailto). Otherwise returns '#'. This prevents
 * open-redirect / script-injection via user-controlled hrefs
 * (e.g. javascript:, data:).
 */
export const safeHref = (url?: string | null): string => {
    if (!url) return '#';
    try {
        // Resolve against the current origin to correctly parse the protocol
        // for both absolute and relative URLs.
        const parsed = new URL(url, window.location.origin);
        if (ALLOWED_PROTOCOLS.includes(parsed.protocol)) {
            return url;
        }
        return '#';
    } catch {
        return '#';
    }
};
