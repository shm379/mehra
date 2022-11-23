import { ref, isRef, unref, watchEffect } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";

export default () => {
    const form = useForm({
        name: "",
        first_name: "",
        last_name: "",
        slug: "",
        description: "",
        birthday: "",
        awards: [],
        types: [],
    });
    const sections = ref([
        {
            title: "مشخصات ",
            anchor: "creator-info",
        },
        {
            title: "تصاویر",
            anchor: "creator-gallery",
        },
        {
            title: "افزودن  جوایز و افتخارات",
            anchor: "creator-award",
        },
    ]);
    const columns = ref([
        {
            name: "id",
            label: "شماره ردیف",
            field: "id",
            sortable: true,
        },
        {
            name: "title",
            label: "عنوان",
            field: "title",
            sortable: true,
        },
        {
            name: "slug",
            label: "نامک",
            field: "slug",
            sortable: false,
        },
        {
            name: "first_name",
            label: "نام",
            field: "first_name",
            sortable: false,
        },
        {
            name: "last_name",
            label: "نام خانوادگی",
            field: "last_name",
            sortable: false,
        },
        {
            name: "types",
            label: "نوع",
            field: "types",
            sortable: false,
        },
        {
            name: "birthday",
            label: "سال تولد",
            field: "birthday",
            sortable: false,
        },
        {
            name: "actions",
            label: "عملیات",
            type: "action",
        },
    ]);

    function pp() {
        alert("here");
    }
    const actions = [
        { title: "نمایش", route: "admin.creators.show", color: "blue" },
        { title: "ویرایش", route: "admin.creators.edit", color: "orange" },
        { title: "حذف", route: "admin.creators.destroy", color: "red" },
    ];
    return { columns, actions, form, sections, pp };
};
