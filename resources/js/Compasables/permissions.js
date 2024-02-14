import {usePage} from "@inertiajs/inertia-vue3";
import { computed } from 'vue'

export function usePermission() {

    const hasRole = (name) => usePage().props.value.auth.user.roles.includes(name);
    const hasRoles = (names) => usePage().props.value.auth.user.roles.some((name => names.includes(name)));

    return { hasRole, hasRoles };
}
