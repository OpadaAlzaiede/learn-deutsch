export function getConstants() {

    const adminRole = () => {

        return 'admin-role';
    }

    const userRole = () => {

        return 'user-role';
    }

    const createWordsPermission = () => {

        return 'add-words-permissions';
    }

    const maximumNumberOfAllowedQuizzes = () => {

        return 5;
    }

    return { adminRole, userRole, maximumNumberOfAllowedQuizzes, createWordsPermission };
}
