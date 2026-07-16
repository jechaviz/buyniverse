import React, { useState } from 'react';
import { useTranslation } from '@/hooks/useTranslation';
import { Invoice } from '@/types';
import Card from '@/components/ui/Card';
import Textarea from '@/components/ui/Textarea';
import Input from '@/components/ui/Input';
import Button from '@/components/ui/Button';

interface InvoiceOptionsSectionProps {
    invoice: Partial<Invoice>;
    updateInvoice: (updates: Partial<Invoice>) => void;
}

const TabButton: React.FC<{tabId: string, activeTab: string, onClick: (tabId: string) => void, children: React.ReactNode}> = ({ tabId, activeTab, onClick, children}) => (
    <button type="button" onClick={() => onClick(tabId)} className={`px-4 py-2 text-sm font-semibold border-b-2 ${activeTab === tabId ? 'border-primary-600 text-primary-600' : 'border-transparent text-slate-500 hover:text-slate-700'}`}>
        {children}
    </button>
);

const InvoiceOptionsSection: React.FC<InvoiceOptionsSectionProps> = ({ invoice, updateInvoice }) => {
    const { t } = useTranslation();
    const [activeTab, setActiveTab] = useState<'notes' | 'email' | 'attachments'>('notes');
    const [attachmentName, setAttachmentName] = useState('');
    const [attachmentUrl, setAttachmentUrl] = useState('');

    const addAttachment = () => {
        const url = attachmentUrl.trim();
        if (!attachmentName.trim() || !/^https?:\/\//i.test(url)) return;
        updateInvoice({
            attachments: [
                ...(invoice.attachments || []),
                { id: `attachment-${Date.now()}`, name: attachmentName.trim(), type: 'link', url },
            ],
        });
        setAttachmentName('');
        setAttachmentUrl('');
    };

    return (
        <Card>
            <div className="border-b border-slate-200 dark:border-slate-700 flex items-center">
                <TabButton tabId="notes" activeTab={activeTab} onClick={() => setActiveTab('notes')}>{t('pages.invoice.form.notes')}</TabButton>
                <TabButton tabId="email" activeTab={activeTab} onClick={() => setActiveTab('email')}>{t('pages.invoice.form.emailSettings')}</TabButton>
                <TabButton tabId="attachments" activeTab={activeTab} onClick={() => setActiveTab('attachments')}>{t('pages.invoice.form.attachments')}</TabButton>
            </div>
            <div className="p-6 min-h-[220px]">
                {activeTab === 'notes' && <Textarea value={invoice.paymentNotes || ''} onChange={e => updateInvoice({ paymentNotes: e.target.value })} rows={5} placeholder={t('pages.invoice.form.paymentNotes')} />}
                {activeTab === 'email' && (
                    <div className="space-y-2">
                        <Input label="To" value={invoice.emailSettings?.to?.join(', ') || ''} onChange={e => updateInvoice({ emailSettings: { ...(invoice.emailSettings as any), to: e.target.value.split(',').map(em => em.trim())} })} />
                        <Input label="CC" value={invoice.emailSettings?.cc?.join(', ') || ''} onChange={e => updateInvoice({ emailSettings: { ...(invoice.emailSettings as any), cc: e.target.value.split(',').map(em => em.trim())} })} />
                        <Input label="Subject" value={invoice.emailSettings?.subject || ''} onChange={e => updateInvoice({ emailSettings: { ...(invoice.emailSettings as any), subject: e.target.value } })} />
                    </div>
                )}
                {activeTab === 'attachments' && (
                    <div className="space-y-3">
                        <div className="grid grid-cols-1 sm:grid-cols-[1fr_2fr_auto] gap-2">
                            <Input placeholder="Attachment name" value={attachmentName} onChange={e => setAttachmentName(e.target.value)} />
                            <Input placeholder="https://…" value={attachmentUrl} onChange={e => setAttachmentUrl(e.target.value)} />
                            <Button type="button" onClick={addAttachment}>Add</Button>
                        </div>
                        {(invoice.attachments || []).map(attachment => (
                            <div key={attachment.id} className="flex items-center justify-between gap-3 rounded border border-slate-200 dark:border-slate-700 px-3 py-2 text-sm">
                                <a href={attachment.url} target="_blank" rel="noopener noreferrer" className="truncate text-primary-600 hover:underline">{attachment.name}</a>
                                <button type="button" onClick={() => updateInvoice({ attachments: invoice.attachments?.filter(item => item.id !== attachment.id) })} className="text-slate-500 hover:text-red-600" aria-label={`Remove ${attachment.name}`}>
                                    <i className="fa-solid fa-trash" />
                                </button>
                            </div>
                        ))}
                    </div>
                )}
            </div>
        </Card>
    );
};

export default InvoiceOptionsSection;
