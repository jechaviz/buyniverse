import React from 'react';
import { Navigate } from 'react-router-dom';
import { useAppState } from '@/context/AppStateContext';
import { UserType } from '@/types';

interface RequireRoleProps {
    allow: UserType[];
    children: React.ReactNode;
}

const RequireRole: React.FC<RequireRoleProps> = ({ allow, children }) => {
    const { currentUser } = useAppState();

    if (!currentUser || !allow.includes(currentUser.type)) {
        return <Navigate to="/" replace />;
    }

    return <>{children}</>;
};

export default RequireRole;
