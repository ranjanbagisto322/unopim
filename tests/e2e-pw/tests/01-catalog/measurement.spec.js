const { test, expect } = require('../../utils/fixtures');

test.describe('UnoPim Measurement Family', () => {
    
    const uniqueCode = 'len_' + Date.now();

    test.beforeEach(async ({ adminPage }) => {
        await adminPage.goto('/admin/measurement/families');
    });

    test('Validation: empty form submit', async ({ adminPage }) => {
        await adminPage.getByRole('button', { name: 'Create' }).click();
        await adminPage.getByRole('button', { name: 'Save' }).click();
        await expect(adminPage.getByText('The Code field is required')).toBeVisible();
        await expect(adminPage.getByText('The Standard Unit Code field is required')).toBeVisible();
    });

    test('Create Measurement Family', async ({ adminPage }) => {
        const uniqueCode = 'len_' + Date.now();

        await adminPage.goto('/admin/measurement/families');
        await adminPage.getByRole('button', { name: 'Create' }).click();

        await adminPage.locator('input[name="code"]').fill(uniqueCode);
        await adminPage.locator('input[name="labels[en_US]"]').fill('Length');
        await adminPage.locator('input[name="standard_unit_code"]').fill('meter');
        await adminPage.locator('input[name="unit_labels[en_US]"]').fill('Meter');
        await adminPage.locator('input[name="symbol"]').fill('m');

        await adminPage.getByRole('button', { name: 'Save' }).click();
    });

    test('Search and Filter Measurement Family', async ({ adminPage }) => {
        const searchInput = adminPage.locator('input[name="search"]');
        await searchInput.fill(uniqueCode);
        await adminPage.keyboard.press('Enter');
        await adminPage.waitForResponse(res => res.url().includes('index') && res.status() === 200);
        
        await expect(adminPage.locator('table')).toContainText(uniqueCode);
    });

    test('Edit Measurement Family', async ({ adminPage }) => {
        const row = adminPage.locator(`tr:has-text("${uniqueCode}")`);
        await row.locator('.icon-edit, [title="Edit"]').first().click();
        await adminPage.waitForLoadState('networkidle');
        await adminPage.locator('input[name="labels[en_US]"]').fill('Updated Length');
        await adminPage.getByRole('button', { name: 'Save' }).click();
        
        await expect(adminPage.getByText('Updated Length')).toBeVisible();
    });

    test.only('Delete Measurement Family', async ({ adminPage }) => {
    const uniqueCode = 'len_' + Date.now();

    await adminPage.goto('/admin/measurement/families');
    await adminPage.getByRole('button', { name: 'Create' }).click();

    await adminPage.locator('input[name="code"]').fill(uniqueCode);
    await adminPage.locator('input[name="labels[en_US]"]').fill('Length');
    await adminPage.locator('input[name="standard_unit_code"]').fill('meter');
    await adminPage.locator('input[name="unit_labels[en_US]"]').fill('Meter');
    await adminPage.locator('input[name="symbol"]').fill('m');

    await adminPage.getByRole('button', { name: 'Save' }).click();
    await adminPage.waitForLoadState('networkidle');

    // back to listing
    await adminPage.goto('/admin/measurement/families');

    const searchInput = adminPage.locator('input[name="search"]:visible');
    await searchInput.fill(uniqueCode);

    // 🔥 FIX: action + wait together
    await Promise.all([
        adminPage.waitForResponse(res =>
            res.url().includes('index') && res.status() === 200
        ),
        adminPage.keyboard.press('Enter'),
    ]);

    const row = adminPage.locator('tr', { hasText: uniqueCode });
    await expect(row).toBeVisible();

    await row.getByTitle('Delete').click();

    const confirmButton = adminPage.getByRole('button', { name: /Agree|Confirm|Delete/i });
    await confirmButton.click();

    await expect(adminPage.getByText(/Deleted Successfully/i)).toBeVisible();
});

});