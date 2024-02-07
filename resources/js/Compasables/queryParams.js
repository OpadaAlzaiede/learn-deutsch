import {usePage} from "@inertiajs/inertia-vue3";

export function queryParams(...args) {

    let queryString = usePage().url.value;

    if (queryString.indexOf("?") === -1) {
        return {};
    }

    queryString = queryString.substring(queryString.indexOf("?") + 1);

    return Object.assign(Object.fromEntries(new URLSearchParams(queryString)), ...args);
}
