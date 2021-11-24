describe("example to-do app", () => {
    beforeEach(() => {
        // Cypress starts out with a blank slate for each test
        // so we must tell it to visit our website with the `cy.visit()` command.
        // Since we want to visit the same URL at the start of all our tests,
        // we include it in our beforeEach function so that it runs before each test
        cy.visit("http://localhost/login");
        cy.get("[data-cy=email]").type("november24@example.com");
        cy.get("[data-cy=password]").type("password");
        cy.get("[data-cy=login-button]").click();
    });

    it("it can upload avatars", () => {
        const newAvatar = "nel.jpg";

        cy.visit("http://localhost/profiles/november24");

        // assert default avatar
        cy.get('[data-cy="avatar-img"]').should(
            "have.attr",
            "src",
            `http://localhost/images/default-avatar.jpg`
        );
        cy.visit("http://localhost/profiles/november24/edit");

        cy.get('[data-cy="choose-file-button"]').attachFile(newAvatar);

        cy.get("[data-cy=password]").type("password");
        cy.get("[data-cy=password-confirm]").type("password");
        cy.get('[data-cy="update-button"]').click();

        // assert new avatar
        cy.get('[data-cy="avatar-img"]').should(
            "have.attr",
            "src",
            `http://localhost/storage/avatars/${newAvatar}`
        );
    });
});
