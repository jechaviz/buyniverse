import { User, UserPermissions, UserType, TeamMember } from '@/types';

// --- PERMISSIONS LOGIC ---
export const getUserPermissions = (user: Omit<User, 'permissions'>, teamMembership?: TeamMember): UserPermissions => {
    const basePermissions = {
        canCreateProjects: false,
        canViewAllProjects: false,
        canEditWorkspaceSettings: false,
        canManageFinances: false,
        isWorkspaceAdmin: false,
    };

    switch (user.type) {
        case UserType.Admin:
            return {
                canCreateProjects: true,
                canViewAllProjects: true,
                canEditWorkspaceSettings: true,
                canManageFinances: true,
                isWorkspaceAdmin: true,
            };
        case UserType.Client: {
            // This could be the workspace owner or a team member.
            const isOwner = !user.clientId || user.clientId === user.id;
            // Fail-closed: a non-owner is only elevated when their membership
            // explicitly grants 'edit'. Any missing/unknown permission stays locked.
            const canEdit = isOwner || teamMembership?.permission === 'edit';

            return {
                ...basePermissions,
                canCreateProjects: canEdit,
                // Owners and explicit team members can view all; otherwise locked.
                canViewAllProjects: isOwner || teamMembership?.permission === 'edit' || teamMembership?.permission === 'view',
                canEditWorkspaceSettings: canEdit,
                canManageFinances: canEdit,
                isWorkspaceAdmin: canEdit,
            };
        }
        case UserType.Freelancer:
            return { ...basePermissions }; // Freelancers have the most restricted permissions by default
        default:
            return { ...basePermissions }; // Fail-closed for any unknown/undefined user type
    }
}
