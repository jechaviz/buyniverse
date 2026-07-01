import React from 'react';

export const exportToCsv = <TData extends { [key: string]: any }>(
    data: TData[],
    columns: { accessorKey: keyof TData | string; header: () => React.ReactNode }[],
    filename: string
): void => {
    const relevantColumns = columns.filter(c => c.accessorKey !== 'action');

    const getHeader = (headerProp: any) => typeof headerProp === 'function' ? headerProp() : String(headerProp);

    // Neutralize CSV/formula injection: cells starting with = + - @ or a TAB/CR
    // are prefixed with an apostrophe so Excel/Sheets won't execute them.
    const escapeCell = (raw: string): string => {
        let safe = raw;
        if (/^[=+\-@\t\r]/.test(safe)) {
            safe = `'${safe}`;
        }
        return `"${safe.replace(/"/g, '""')}"`;
    };

    const headers = relevantColumns.map(c => escapeCell(String(getHeader(c.header) ?? ''))).join(',');
    
    const rows = data.map(row => {
        return relevantColumns.map(col => {
            const value = row[col.accessorKey as keyof TData];
            let displayValue: string;

            if (typeof value === 'object' && value !== null) {
                if ('name' in value) {
                     displayValue = (value as { name: string }).name;
                } else if (Object.prototype.toString.call(value) === '[object Date]') {
                    displayValue = (value as Date).toISOString();
                }
                else {
                    displayValue = JSON.stringify(value);
                }
            } else {
                displayValue = String(value ?? '');
            }
            
            return escapeCell(displayValue);
        }).join(',');
    }).join('\n');

    const csvContent = `${headers}\n${rows}`;
    
    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    const link = document.createElement('a');
    
    if (link.download !== undefined) {
        const url = URL.createObjectURL(blob);
        link.setAttribute('href', url);
        link.setAttribute('download', filename);
        link.style.visibility = 'hidden';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
};


export const parseCsv = (csvText: string): Record<string, string>[] => {
    const lines = csvText.trim().split('\n');
    if (lines.length < 2) return [];

    const headers = lines[0].split(',').map(h => h.trim().replace(/"/g, ''));
    const rows = lines.slice(1).map(line => {
        // Basic CSV parsing, doesn't handle commas inside quotes
        const values = line.split(',').map(v => v.trim().replace(/"/g, ''));
        const rowObject: Record<string, string> = {};
        headers.forEach((header, index) => {
            rowObject[header] = values[index];
        });
        return rowObject;
    });

    return rows;
};