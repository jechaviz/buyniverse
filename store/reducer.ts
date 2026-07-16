import { AppState, Action, JobStatus, ProposalStatus, MilestoneStatus, UserType, ApprovalStatus, TaskStatus, LeadStatus, FileCategory, AgencyRole, ContestStatus } from '@/types';
import { getUserPermissions } from '@/utils/permissions';
import { initialState } from './initialState';

const uniqueIds = (ids: string[] = [], id: string) => ids.includes(id) ? ids : [...ids, id];
const withoutId = (ids: string[] = [], id: string) => ids.filter(value => value !== id);

const updateCurrentUser = (state: AppState, data: Partial<AppState['currentUser']>): AppState => {
    const currentUser = { ...state.currentUser, ...data };
    return {
        ...state,
        currentUser,
        users: state.users.map(user => user.id === currentUser.id ? currentUser : user),
    };
};

export const appReducer = (state: AppState, action: Action): AppState => {
    switch (action.type) {
        case 'SWITCH_TO_USER':
            const userToSwitch = state.users.find(u => u.id === action.payload.userId);
            if (userToSwitch) {
                return { ...state, currentUser: userToSwitch };
            }
            return state;

        case 'TOGGLE_SAVE_JOB': {
            if (state.currentUser.type !== UserType.Freelancer) return state;
            const savedJobs = state.currentUser.savedJobs || [];
            const newSavedJobs = savedJobs.includes(action.payload.jobId)
                ? savedJobs.filter(id => id !== action.payload.jobId)
                : [...savedJobs, action.payload.jobId];
            
            const updatedUser = { ...state.currentUser, savedJobs: newSavedJobs };
            return {
                ...state,
                currentUser: updatedUser,
                users: state.users.map(u => u.id === updatedUser.id ? updatedUser : u),
            };
        }
        
        case 'UPDATE_JOB':
        case 'UPDATE_JOB_DRAFT':
             return {
                ...state,
                jobs: state.jobs.map(j => j.id === action.payload.jobId ? { ...j, ...action.payload.data } : j),
            };

        case 'ADD_PROPOSAL':
            return {
                ...state,
                jobs: state.jobs.map(job =>
                    job.id === action.payload.proposal.jobId
                        ? { ...job, proposals: [...job.proposals, action.payload.proposal] }
                        : job
                ),
                conversations: [...state.conversations, action.payload.conversation],
                notifications: [...state.notifications, action.payload.notification],
            };

        case 'ADD_REVIEW':
            return { ...state, reviews: [...state.reviews, action.payload] };

        case 'POST_QUESTION':
            return {
                ...state,
                jobs: state.jobs.map(job => job.id === action.payload.jobId
                    ? { ...job, questions: [...job.questions, action.payload.question] }
                    : job),
            };

        case 'ANSWER_QUESTION':
            return {
                ...state,
                jobs: state.jobs.map(job => job.id === action.payload.jobId
                    ? {
                        ...job,
                        questions: job.questions.map(question => question.id === action.payload.questionId
                            ? { ...question, answer: { text: action.payload.answerText, answeredAt: new Date() } }
                            : question),
                    }
                    : job),
            };

        case 'SEND_MESSAGE': {
            const conversationExists = state.conversations.some(conversation => conversation.id === action.payload.conversationId);
            if (!conversationExists) return state;
            return {
                ...state,
                conversations: state.conversations.map(conversation => conversation.id === action.payload.conversationId
                    ? { ...conversation, messages: [...conversation.messages, action.payload.message] }
                    : conversation),
                notifications: action.payload.notification
                    ? [...state.notifications, action.payload.notification]
                    : state.notifications,
            };
        }

        case 'MARK_NOTIFICATIONS_READ':
            return {
                ...state,
                notifications: state.notifications.map(notification => notification.userId === state.currentUser.id
                    ? { ...notification, isRead: true }
                    : notification),
            };
            
        case 'HIRE_FREELANCER':
            return {
                ...state,
                jobs: state.jobs.map(job =>
                    job.id === action.payload.jobId
                        ? {
                            ...job,
                            status: JobStatus.InProgress,
                            contractId: action.payload.contract.id,
                            proposals: job.proposals.map(p =>
                                p.id === action.payload.proposalId
                                    ? { ...p, status: ProposalStatus.Accepted }
                                    : { ...p, status: ProposalStatus.Rejected }
                            )
                        }
                        : job
                ),
                contracts: [...state.contracts, action.payload.contract],
                notifications: [...state.notifications, action.payload.notification],
            };
        
        case 'MARK_JOB_COMPLETE': {
            return {
                ...state,
                jobs: state.jobs.map(j => j.id === action.payload.jobId ? { ...j, status: JobStatus.Completed } : j),
                contracts: state.contracts.map(c => c.id === action.payload.contractId ? { ...c, endedAt: new Date() } : c),
                notifications: [...state.notifications, action.payload.clientNotification, action.payload.freelancerNotification],
                invoices: [...state.invoices, action.payload.invoice],
            };
        }

        case 'CREATE_AGENCY': {
            if (state.currentUser.agencyId) return state;
            const agency = {
                ...action.payload.agency,
                ownerId: state.currentUser.id,
                members: [{ userId: state.currentUser.id, role: AgencyRole.Owner }],
            };
            return updateCurrentUser(
                { ...state, agencies: [...state.agencies, agency] },
                { agencyId: agency.id, agencyRole: AgencyRole.Owner },
            );
        }

        case 'UPDATE_AGENCY_PROFILE': {
            const agency = state.agencies.find(item => item.id === action.payload.agencyId);
            const canManage = agency?.members.some(member => member.userId === state.currentUser.id
                && (member.role === AgencyRole.Owner || member.role === AgencyRole.Admin));
            if (!agency || !canManage) return state;
            return {
                ...state,
                agencies: state.agencies.map(item => item.id === agency.id
                    ? { ...item, ...action.payload.data, id: item.id, ownerId: item.ownerId, members: item.members }
                    : item),
            };
        }

        case 'SET_AVAILABILITY':
            return state.currentUser.type === UserType.Freelancer
                ? updateCurrentUser(state, { availabilityStatus: action.payload.status })
                : state;

        case 'LOG_TIME': {
            const contract = state.contracts.find(item => item.id === action.payload.timeEntry.contractId);
            if (!contract || contract.providerId !== state.currentUser.id) return state;
            return {
                ...state,
                timeEntries: [...state.timeEntries, action.payload.timeEntry],
                notifications: [...state.notifications, action.payload.notification],
            };
        }

        case 'PURCHASE_GIG':
            return {
                ...state,
                contracts: [...state.contracts, action.payload.contract],
                invoices: [...state.invoices, action.payload.invoice],
                transactions: [...state.transactions, action.payload.transaction],
                notifications: [...state.notifications, action.payload.notification],
            };

        case 'CREATE_CONTEST':
            return {
                ...state,
                contests: [...state.contests, action.payload.contest],
                conversations: [...state.conversations, action.payload.conversation],
                notifications: [...state.notifications, ...action.payload.notifications],
                jobs: state.jobs.map(job => job.id === action.payload.contest.jobId
                    ? { ...job, contestId: action.payload.contest.id }
                    : job),
            };

        case 'UPDATE_PROPOSAL_BID': {
            const conversation = state.conversations.find(item => item.jobId === action.payload.jobId
                && item.participants.includes(action.payload.message.senderId));
            return {
                ...state,
                jobs: state.jobs.map(job => job.id === action.payload.jobId
                    ? {
                        ...job,
                        proposals: job.proposals.map(proposal => proposal.id === action.payload.proposalId
                            ? { ...proposal, bid: action.payload.newBid }
                            : proposal),
                    }
                    : job),
                conversations: conversation
                    ? state.conversations.map(item => item.id === conversation.id
                        ? { ...item, messages: [...item.messages, action.payload.message] }
                        : item)
                    : state.conversations,
                notifications: [...state.notifications, action.payload.notification],
            };
        }

        case 'SELECT_CONTEST_WINNER':
            return {
                ...state,
                contests: state.contests.map(contest => contest.id === action.payload.contestId
                    ? { ...contest, status: ContestStatus.Finished, winnerId: action.payload.winnerId }
                    : contest),
                jobs: state.jobs.map(job => job.id === action.payload.jobId
                    ? {
                        ...job,
                        status: JobStatus.InProgress,
                        contractId: action.payload.contract.id,
                        proposals: job.proposals.map(proposal => ({
                            ...proposal,
                            status: proposal.freelancerId === action.payload.winnerId
                                ? ProposalStatus.Accepted
                                : ProposalStatus.Rejected,
                        })),
                    }
                    : job),
                contracts: [...state.contracts, action.payload.contract],
                notifications: [...state.notifications, ...action.payload.notifications],
            };

        case 'CREATE_MILESTONE': {
            return {
                ...state,
                contracts: state.contracts.map(c =>
                    c.id === action.payload.contractId
                        ? { ...c, milestones: [...c.milestones, action.payload.milestone] }
                        : c
                )
            };
        }

        case 'FUND_MILESTONE':
        case 'REQUEST_MILESTONE_PAYMENT':
        case 'RELEASE_MILESTONE_PAYMENT': {
            if (action.type === 'RELEASE_MILESTONE_PAYMENT') {
                const contract = state.contracts.find(c => c.id === action.payload.contractId);
                if (!contract || contract.clientId !== state.currentUser.id) return state;
            }

            const statusMap = {
                'FUND_MILESTONE': MilestoneStatus.Funded,
                'REQUEST_MILESTONE_PAYMENT': MilestoneStatus.Requested,
                'RELEASE_MILESTONE_PAYMENT': MilestoneStatus.Released,
            };

            const newState = {
                ...state,
                contracts: state.contracts.map(c => {
                    if (c.id === action.payload.contractId) {
                        return {
                            ...c,
                            milestones: c.milestones.map(m =>
                                m.id === action.payload.milestoneId ? { ...m, status: statusMap[action.type] } : m
                            )
                        };
                    }
                    return c;
                }),
                notifications: [...state.notifications, action.payload.notification],
            };

            if (action.type === 'RELEASE_MILESTONE_PAYMENT') {
                newState.transactions = [...state.transactions, action.payload.transaction];
            }

            return newState;
        }

        case 'CREATE_TASK': {
             return {
                ...state,
                contracts: state.contracts.map(c => {
                    if (c.id === action.payload.contractId) {
                        return {
                            ...c,
                            milestones: c.milestones.map(m =>
                                m.id === action.payload.milestoneId ? { ...m, tasks: [...m.tasks, action.payload.task] } : m
                            )
                        };
                    }
                    return c;
                })
            };
        }
        
        case 'UPDATE_TASK_STATUS': {
            return {
                ...state,
                contracts: state.contracts.map(c => {
                    if (c.id === action.payload.contractId) {
                        return {
                            ...c,
                            milestones: c.milestones.map(m => {
                                if (m.id === action.payload.milestoneId) {
                                    return {
                                        ...m,
                                        tasks: m.tasks.map(t =>
                                            t.id === action.payload.taskId ? { ...t, status: action.payload.newStatus } : t
                                        )
                                    };
                                }
                                return m;
                            })
                        };
                    }
                    return c;
                })
            };
        }
        
        case 'APPROVE_JOB': {
            const newJobs = state.jobs.map(j => {
                if (j.id === action.payload.jobId) {
                    const newApprovers = j.approvers.map(a => a.userId === action.payload.approverId ? { ...a, status: ApprovalStatus.Approved } : a);
                    const allApproved = newApprovers.every(a => a.status === ApprovalStatus.Approved);
                    return { ...j, approvers: newApprovers, status: allApproved ? JobStatus.Open : j.status };
                }
                return j;
            });
            return {
                ...state,
                jobs: newJobs,
                notifications: [...state.notifications, action.payload.notification]
            };
        }
        
        case 'REJECT_JOB': {
             const newJobs = state.jobs.map(j => {
                if (j.id === action.payload.jobId) {
                    const newApprovers = j.approvers.map(a => a.userId === action.payload.approverId ? { ...a, status: ApprovalStatus.Rejected, rejectionReason: action.payload.reason } : a);
                    return { ...j, approvers: newApprovers, status: JobStatus.Rejected };
                }
                return j;
            });
            return {
                ...state,
                jobs: newJobs,
                notifications: [...state.notifications, action.payload.notification]
            };
        }
        
        case 'CREATE_JOB_DRAFT':
            return {
                ...state,
                jobs: [...state.jobs, action.payload],
            };

        case 'ADD_WIDGET': {
            const { tableId, categoryId, newCategoryTitle, widget } = action.payload;
            const newLayouts = { ...state.dashboardLayouts };
            const tableLayout = [...(newLayouts[tableId] || [])];
            
            let targetCategoryId = categoryId;

            if (newCategoryTitle) {
                const newCategory = { id: `cat-${Date.now()}`, title: newCategoryTitle, widgets: [] };
                tableLayout.push(newCategory);
                targetCategoryId = newCategory.id;
            }

            const targetCategoryIndex = tableLayout.findIndex(c => c.id === targetCategoryId);
            if (targetCategoryIndex !== -1) {
                tableLayout[targetCategoryIndex].widgets.push(widget);
            } else if (tableLayout.length > 0) {
                 tableLayout[0].widgets.push(widget);
            } else {
                 tableLayout.push({ id: `cat-${Date.now()}`, title: 'Default', widgets: [widget] });
            }
            
            newLayouts[tableId] = tableLayout;

            return { ...state, dashboardLayouts: newLayouts };
        }

        case 'UPDATE_WIDGET': {
             const { tableId, widget } = action.payload;
             const newLayouts = { ...state.dashboardLayouts };
             const tableLayout = (newLayouts[tableId] || []).map(category => ({
                ...category,
                widgets: category.widgets.map(w => w.id === widget.id ? widget : w)
             }));
             newLayouts[tableId] = tableLayout;
             return { ...state, dashboardLayouts: newLayouts };
        }

        case 'DELETE_WIDGET': {
            const { tableId, widgetId } = action.payload;
            const newLayouts = { ...state.dashboardLayouts };
            const tableLayout = (newLayouts[tableId] || []).map(category => ({
                ...category,
                widgets: category.widgets.filter(w => w.id !== widgetId)
            })).filter(category => category.widgets.length > 0);
            newLayouts[tableId] = tableLayout;
            return { ...state, dashboardLayouts: newLayouts };
        }

        case 'UPDATE_CATEGORY_TITLE':
            return {
                ...state,
                dashboardLayouts: {
                    ...state.dashboardLayouts,
                    [action.payload.tableId]: (state.dashboardLayouts[action.payload.tableId] || []).map(category => category.id === action.payload.categoryId
                        ? { ...category, title: action.payload.title }
                        : category),
                },
            };

        case 'SET_DASHBOARD_LAYOUT':
            return {
                ...state,
                dashboardLayouts: { ...state.dashboardLayouts, [action.payload.tableId]: action.payload.layout },
            };

        case 'DUPLICATE_WIDGET': {
            const categories = state.dashboardLayouts[action.payload.tableId] || [];
            return {
                ...state,
                dashboardLayouts: {
                    ...state.dashboardLayouts,
                    [action.payload.tableId]: categories.map(category => {
                        if (category.id !== action.payload.categoryId) return category;
                        const widget = category.widgets.find(item => item.id === action.payload.widgetId);
                        return widget
                            ? { ...category, widgets: [...category.widgets, { ...widget, id: `widget-${Date.now()}`, title: `${widget.title} copy` }] }
                            : category;
                    }),
                },
            };
        }

        case 'SAVE_TABLE_VIEW':
            return {
                ...state,
                tableViews: {
                    ...state.tableViews,
                    [action.payload.tableId]: [...(state.tableViews[action.payload.tableId] || []), action.payload.view],
                },
            };

        case 'UPDATE_TABLE_VIEW':
            return {
                ...state,
                tableViews: {
                    ...state.tableViews,
                    [action.payload.tableId]: (state.tableViews[action.payload.tableId] || []).map(view => view.id === action.payload.view.id
                        ? action.payload.view
                        : view),
                },
            };

        case 'DELETE_TABLE_VIEW':
            return {
                ...state,
                tableViews: {
                    ...state.tableViews,
                    [action.payload.tableId]: (state.tableViews[action.payload.tableId] || []).filter(view => view.id !== action.payload.viewId),
                },
            };
        
        case 'UPDATE_ENTITY': {
            const { entity, id, data } = action.payload;
            if (!state[entity] || !Array.isArray(state[entity])) return state;
            
            const updatedEntity = (state[entity] as any[]).map(item =>
                item.id === id ? { ...item, ...data } : item
            );

            return { ...state, [entity]: updatedEntity };
        }
        
        case 'BULK_UPDATE_LEAD_STATUS': {
            return {
                ...state,
                leads: state.leads.map(lead => 
                    action.payload.leadIds.includes(lead.id) ? { ...lead, status: action.payload.status } : lead
                )
            };
        }

        case 'BULK_ADD_LEADS':
            return {
                ...state,
                leads: [
                    ...state.leads,
                    ...action.payload.leads.map((lead, index) => ({
                        ...lead,
                        id: `lead-${Date.now()}-${index}`,
                        createdAt: new Date(),
                        assignedTo: [state.currentUser.id],
                    })),
                ],
            };

        case 'UPDATE_PRODUCT':
            return {
                ...state,
                products: state.products.map(product => product.id === action.payload.id
                    ? { ...product, ...action.payload.data }
                    : product),
            };

        case 'UPDATE_EXPENSE':
            return {
                ...state,
                expenses: state.expenses.map(expense => expense.id === action.payload.id
                    ? { ...expense, ...action.payload.data }
                    : expense),
            };
        
        case 'REORDER_MILESTONE_CATEGORIES': {
            return {
                ...state,
                jobs: state.jobs.map(job => {
                    if (job.id === action.payload.projectId) {
                        const newOrderMap = new Map(action.payload.orderedCategoryIds.map((id, index) => [id, index]));
                        const sortedCategories = [...job.milestoneCategories].sort((a,b) => (newOrderMap.get(a.id) ?? 99) - (newOrderMap.get(b.id) ?? 99));
                        return { ...job, milestoneCategories: sortedCategories };
                    }
                    return job;
                })
            }
        }

        case 'INVITE_FREELANCER':
            return {
                ...state,
                jobs: state.jobs.map(job => job.id === action.payload.jobId
                    ? { ...job, invitedFreelancerIds: uniqueIds(job.invitedFreelancerIds, action.payload.freelancerId) }
                    : job),
                notifications: [...state.notifications, action.payload.notification],
            };

        case 'SET_PROVIDER_GROUP':
            return {
                ...state,
                jobs: state.jobs.map(job => {
                    if (job.id !== action.payload.jobId) return job;
                    const providerId = action.payload.providerId;
                    const base = {
                        ...job,
                        shortlistedProviderIds: withoutId(job.shortlistedProviderIds, providerId),
                        ignoredProviderIds: withoutId(job.ignoredProviderIds, providerId),
                        invitedFreelancerIds: withoutId(job.invitedFreelancerIds, providerId),
                    };
                    if (action.payload.targetGroup === 'shortlisted') {
                        return { ...base, shortlistedProviderIds: uniqueIds(base.shortlistedProviderIds, providerId) };
                    }
                    if (action.payload.targetGroup === 'ignored') {
                        return { ...base, ignoredProviderIds: uniqueIds(base.ignoredProviderIds, providerId) };
                    }
                    if (action.payload.targetGroup === 'invited') {
                        return { ...base, invitedFreelancerIds: uniqueIds(base.invitedFreelancerIds, providerId) };
                    }
                    return base;
                }),
            };

        case 'UPDATE_PROPOSAL_QUALIFICATION':
            return {
                ...state,
                jobs: state.jobs.map(job => job.id === action.payload.jobId
                    ? {
                        ...job,
                        proposals: job.proposals.map(proposal => proposal.freelancerId === action.payload.providerId
                            ? { ...proposal, qualificationStatus: action.payload.status }
                            : proposal),
                    }
                    : job),
            };

        case 'SHORTLIST_FOR_PROPOSAL':
            return {
                ...state,
                jobs: state.jobs.map(job => job.id === action.payload.jobId
                    ? {
                        ...job,
                        shortlistedProviderIds: action.payload.providerIds,
                        ignoredProviderIds: (job.ignoredProviderIds || []).filter(id => !action.payload.providerIds.includes(id)),
                    }
                    : job),
            };

        case 'ADD_COMMENT':
            return {
                ...state,
                jobs: state.jobs.map(job => job.id === action.payload.projectId
                    ? { ...job, comments: [...job.comments, action.payload.comment] }
                    : job),
            };

        case 'CREATE_NEW_FILE': {
            const file = {
                ...action.payload.file,
                id: `file-${Date.now()}`,
                uploadedAt: new Date(),
                uploadedById: state.currentUser.id,
                size: action.payload.file.content?.length || 0,
                status: 'Uploaded' as const,
                category: action.payload.file.category || FileCategory.Other,
            };
            return {
                ...state,
                jobs: state.jobs.map(job => job.id === action.payload.projectId
                    ? { ...job, files: [...job.files, file] }
                    : job),
            };
        }

        case 'CREATE_NEW_FOLDER': {
            const normalizedPath = action.payload.folderPath.replace(/^\/+|\/+$/g, '');
            if (!normalizedPath) return state;
            const placeholder = {
                id: `folder-${Date.now()}`,
                name: '.placeholder',
                path: `${normalizedPath}/.placeholder`,
                size: 0,
                type: 'system/folder',
                uploadedAt: new Date(),
                uploadedById: state.currentUser.id,
                status: 'Uploaded' as const,
                category: FileCategory.Other,
            };
            return {
                ...state,
                jobs: state.jobs.map(job => job.id === action.payload.projectId
                    && !job.files.some(file => file.path === placeholder.path)
                    ? { ...job, files: [...job.files, placeholder] }
                    : job),
            };
        }

        case 'UPDATE_FILE_CONTENT':
            return {
                ...state,
                jobs: state.jobs.map(job => job.id === action.payload.projectId
                    ? {
                        ...job,
                        files: job.files.map(file => file.id === action.payload.fileId
                            ? { ...file, content: action.payload.newContent, size: action.payload.newContent.length, status: 'Modified' }
                            : file),
                    }
                    : job),
            };

        case 'RENAME_NODE':
            return {
                ...state,
                jobs: state.jobs.map(job => {
                    if (job.id !== action.payload.projectId) return job;
                    if (action.payload.nodeType === 'file') {
                        return {
                            ...job,
                            files: job.files.map(file => file.id === action.payload.nodeId
                                ? { ...file, name: action.payload.newName, path: `${file.path.slice(0, file.path.lastIndexOf('/') + 1)}${action.payload.newName}` }
                                : file),
                        };
                    }
                    const folderPath = action.payload.nodeId.replace(/\/+$/, '');
                    return {
                        ...job,
                        files: job.files.map(file => file.path.startsWith(`${folderPath}/`)
                            ? { ...file, path: `${action.payload.newName}${file.path.slice(folderPath.length)}` }
                            : file),
                    };
                }),
            };

        case 'DELETE_NODE':
            return {
                ...state,
                jobs: state.jobs.map(job => job.id === action.payload.projectId
                    ? {
                        ...job,
                        files: job.files.filter(file => action.payload.nodeType === 'file'
                            ? file.id !== action.payload.nodeId
                            : !file.path.startsWith(`${action.payload.nodeId.replace(/\/+$/, '')}/`)),
                    }
                    : job),
            };

        case 'UPLOAD_FILE':
            return {
                ...state,
                jobs: state.jobs.map(job => job.id === action.payload.projectId
                    ? { ...job, files: [...job.files, action.payload.file] }
                    : job),
            };
        
        case 'ADD_INVOICE':
            return { ...state, invoices: [...state.invoices, action.payload.invoice] };
        
        case 'UPDATE_INVOICE':
             return { ...state, invoices: state.invoices.map(i => i.id === action.payload.invoice.id ? action.payload.invoice : i) };

        case 'CANCEL_INVOICE': {
            return {
                ...state,
                invoices: state.invoices.map(i => i.id === action.payload.invoiceId ? { ...i, status: 'Cancelado', cancellationDetails: { motive: action.payload.motive, replacementUuid: action.payload.replacementUuid } } : i)
            };
        }
        
        case 'ADD_PAYMENT_RECEIPT':
            return { ...state, paymentReceipts: [...state.paymentReceipts, action.payload.payment] };
        
        case 'UPDATE_PAYMENT_RECEIPT':
            return { ...state, paymentReceipts: state.paymentReceipts.map(p => p.id === action.payload.payment.id ? action.payload.payment : p) };

        case 'ADD_JOB': {
            return {
                ...state,
                jobs: [...state.jobs, action.payload]
            }
        }
        
        case 'UPDATE_ISSUER': {
            if (state.currentUser.type !== UserType.Admin) return state;
            const existing = state.issuers.find(i => i.id === action.payload.issuer.id);
            if (existing) {
                return { ...state, issuers: state.issuers.map(i => i.id === action.payload.issuer.id ? action.payload.issuer : i) };
            }
            return { ...state, issuers: [...state.issuers, action.payload.issuer] };
        }
        
        case 'PURCHASE_FOLIOS': {
             if (state.currentUser.type !== UserType.Admin) return state;
             const updatedUser = { ...state.currentUser, folioBalance: (state.currentUser.folioBalance || 0) + action.payload.amount };
             return {
                ...state,
                currentUser: updatedUser,
                users: state.users.map(u => u.id === updatedUser.id ? updatedUser : u),
            };
        }
        
        case 'CONSUME_FOLIO': {
            const { userId } = action.payload;
            const decrement = (balance?: number) => Math.max(0, (balance || 0) - 1);
            const updatedCurrentUser = state.currentUser.id === userId
                ? { ...state.currentUser, folioBalance: decrement(state.currentUser.folioBalance) }
                : state.currentUser;
            return {
                ...state,
                currentUser: updatedCurrentUser,
                users: state.users.map(u => u.id === userId ? { ...u, folioBalance: decrement(u.folioBalance) } : u),
            };
        }

        case 'UPDATE_USER_SETTINGS': {
            const updatedUserSettings = {
                ...state.currentUser.settings,
                ...action.payload,
            };
            const updatedUser = {
                ...state.currentUser,
                settings: updatedUserSettings,
            };
            return {
                ...state,
                currentUser: updatedUser,
                users: state.users.map(u => u.id === updatedUser.id ? updatedUser : u),
            };
        }

        case 'UPDATE_JOB_PROGRESS': {
            return {
                ...state,
                jobs: state.jobs.map(j => j.id === action.payload.jobId ? { ...j, progress: action.payload.progress } : j)
            };
        }

        default:
            return state;
    }
};
