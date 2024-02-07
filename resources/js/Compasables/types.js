import {usePage} from "@inertiajs/inertia-vue3";

export function useTypes() {

    const getRowColor = (type) => {

        if(type === "Maskulinum") return "bg-indigo-50";
        if(type === "Feminunum") return "bg-red-50";
        if(type === "Neuturm") return "bg-green-50";

        return "white";
    }

    return { getRowColor };
}

