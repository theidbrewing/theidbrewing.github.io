import { visitAdminPage,createURL } from '@wordpress/e2e-test-utils';

describe('TT1 Skin', () => {

    it('Sample Test', async () => {
        await visitAdminPage( '/' );
        expect(true).toEqual(true);
    });

});
