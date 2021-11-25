import { visitAdminPage, createNewPost, clickBlockAppender, getEditedPostContent, activateTheme } from '@wordpress/e2e-test-utils';

describe('TT1 Skin', () => {

    // it('Sample Test', async () => {
    //     await visitAdminPage( '/' );
    //     expect(true).toEqual(true);
    // });

    beforeEach(async () => {
        await activateTheme('twentytwentyone');
        await createNewPost();
    });

    it('should have the heading block custom style', async () => {
        await clickBlockAppender();
        await page.keyboard.type('## 2');
        //select custom style
        await page.click(
            `.block-editor-block-styles__item[aria-label="section title"]`
        );
        expect(await getEditedPostContent()).toMatchSnapshot();
    });

});
