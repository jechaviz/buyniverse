import { AppState, ContractType } from '@/types';

const fail = (issues: string[]) => {
    if (issues.length > 0) {
        throw new Error(`Invalid demo graph:\n${issues.map(issue => `- ${issue}`).join('\n')}`);
    }
};

/**
 * Keeps the in-memory demo useful as an integration fixture: every visible
 * object has a valid owner/source and each financial document is traceable.
 */
export const assertDemoStateIntegrity = (state: AppState): void => {
    const issues: string[] = [];
    const userIds = new Set(state.users.map(user => user.id));
    const jobIds = new Set(state.jobs.map(job => job.id));
    const contractIds = new Set(state.contracts.map(contract => contract.id));
    const invoiceIds = new Set(state.invoices.map(invoice => invoice.id));
    const invoiceUuids = new Set(state.invoices.flatMap(invoice => invoice.uuid ? [invoice.uuid] : []));
    const issuerIds = new Set(state.issuers.map(issuer => issuer.id));
    const agencyIds = new Set(state.agencies.map(agency => agency.id));
    const gigIds = new Set(state.gigs.map(gig => gig.id));

    state.agencies.forEach(agency => {
        if (!userIds.has(agency.ownerId)) issues.push(`agency ${agency.id} has an unknown owner`);
        agency.members.forEach(member => {
            if (!userIds.has(member.userId)) issues.push(`agency ${agency.id} has an unknown member`);
        });
    });

    state.users.forEach(user => {
        if (user.agencyId && !agencyIds.has(user.agencyId)) issues.push(`user ${user.id} points to an unknown agency`);
    });

    state.gigs.forEach(gig => {
        const exists = gig.creatorType === 'agency' ? agencyIds.has(gig.creatorId) : userIds.has(gig.creatorId);
        if (!exists) issues.push(`gig ${gig.id} has an unknown creator`);
    });

    state.jobs.forEach(job => {
        if (!userIds.has(job.clientId)) issues.push(`job ${job.id} has an unknown client`);
        if (job.contractId && !contractIds.has(job.contractId)) issues.push(`job ${job.id} points to an unknown contract`);
        job.proposals.forEach(proposal => {
            if (proposal.jobId !== job.id) issues.push(`proposal ${proposal.id} is attached to the wrong job`);
            if (!userIds.has(proposal.freelancerId)) issues.push(`proposal ${proposal.id} has an unknown freelancer`);
        });
        job.questions.forEach(question => {
            if (!userIds.has(question.userId)) issues.push(`question ${question.id} has an unknown author`);
        });
        job.files.forEach(file => {
            if (!userIds.has(file.uploadedById)) issues.push(`file ${file.id} has an unknown uploader`);
        });
    });

    state.contracts.forEach(contract => {
        const sourceExists = contract.type === ContractType.Gig ? gigIds.has(contract.sourceId) : jobIds.has(contract.sourceId);
        if (!sourceExists) issues.push(`contract ${contract.id} has an unknown source`);
        if (!userIds.has(contract.clientId)) issues.push(`contract ${contract.id} has an unknown client`);
        if (!userIds.has(contract.providerId) && !agencyIds.has(contract.providerId)) issues.push(`contract ${contract.id} has an unknown provider`);
        if (contract.type === ContractType.Job) {
            const job = state.jobs.find(item => item.id === contract.sourceId);
            if (job?.contractId !== contract.id) issues.push(`job ${contract.sourceId} is not linked back to contract ${contract.id}`);
        }
    });

    state.contests.forEach(contest => {
        const job = state.jobs.find(item => item.id === contest.jobId);
        if (!job) issues.push(`contest ${contest.id} has an unknown job`);
        else if (job.contestId !== contest.id) issues.push(`job ${job.id} is not linked back to contest ${contest.id}`);
        if (contest.winnerId && !job?.proposals.some(proposal => proposal.freelancerId === contest.winnerId)) {
            issues.push(`contest ${contest.id} winner is not a participant`);
        }
    });

    state.conversations.forEach(conversation => {
        if (!jobIds.has(conversation.jobId)) issues.push(`conversation ${conversation.id} has an unknown job`);
        conversation.participants.forEach(userId => {
            if (!userIds.has(userId)) issues.push(`conversation ${conversation.id} has an unknown participant`);
        });
        conversation.messages.forEach(message => {
            if (!conversation.participants.includes(message.senderId)) issues.push(`message ${message.id} sender is not a participant`);
        });
    });

    state.invoices.forEach(invoice => {
        if (!issuerIds.has(invoice.issuerId)) issues.push(`invoice ${invoice.id} has an unknown issuer`);
        if (!userIds.has(invoice.clientId)) issues.push(`invoice ${invoice.id} has an unknown client`);
        if (!userIds.has(invoice.providerId) && !agencyIds.has(invoice.providerId)) issues.push(`invoice ${invoice.id} has an unknown provider`);
        if (invoice.contractId && !contractIds.has(invoice.contractId)) issues.push(`invoice ${invoice.id} has an unknown contract`);
        if (invoice.amount !== invoice.total) issues.push(`invoice ${invoice.id} amount and total differ`);
    });

    state.payments.forEach(payment => {
        if (!invoiceIds.has(payment.invoiceId)) issues.push(`payment ${payment.id} has an unknown invoice`);
        if (!userIds.has(payment.clientId)) issues.push(`payment ${payment.id} has an unknown client`);
        if (!jobIds.has(payment.projectId)) issues.push(`payment ${payment.id} has an unknown project`);
    });

    state.paymentReceipts.forEach(receipt => {
        if (!issuerIds.has(receipt.issuerId)) issues.push(`payment receipt ${receipt.id} has an unknown issuer`);
        if (!userIds.has(receipt.receiverId)) issues.push(`payment receipt ${receipt.id} has an unknown receiver`);
        receipt.relatedDocuments.forEach(document => {
            if (!invoiceUuids.has(document.documentId)) issues.push(`payment receipt ${receipt.id} references an unknown invoice UUID`);
            if (document.newBalance !== document.previousBalance - document.amountPaid) issues.push(`payment receipt ${receipt.id} has an inconsistent document balance`);
        });
    });

    state.transactions.forEach(transaction => {
        if (!userIds.has(transaction.userId)) issues.push(`transaction ${transaction.id} has an unknown user`);
        if (!invoiceIds.has(transaction.invoiceId)) issues.push(`transaction ${transaction.id} has an unknown invoice`);
    });

    state.timeEntries.forEach(entry => {
        if (!contractIds.has(entry.contractId)) issues.push(`time entry ${entry.id} has an unknown contract`);
        if (!userIds.has(entry.userId)) issues.push(`time entry ${entry.id} has an unknown user`);
    });

    fail(issues);
};
