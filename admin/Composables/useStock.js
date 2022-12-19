import { ref, isRef, unref, watchEffect } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";

export default () => {
    const form = useForm({

    }), sections = ref([
        {
            title: "مشخصات ",
            anchor: "creator-info",
        },
    ]), columns = ref([
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
            name: "type",
            label: "نوع",
            field: "type",
            sortable: false,
        },
        {
            name: "location",
            label: "مکان",
            field: "location",
            sortable: false,
        },
        {
            name: "products_count",
            label: "تعداد محصولات",
            field: "products_count",
            sortable: false,
        },
        {
            name: "priority",
            label: "اولویت",
            field: "priority",
            sortable: false,
        },
        {
            name: "actions",
            label: "عملیات",
            type: "action",
        },
    ]);

    const actions = [
        { title: "نمایش", route: "admin.products.show", color: "blue" },
        { title: "ویرایش", route: "admin.products.edit", color: "orange" },
        { title: "حذف", route: "admin.products.destroy", color: "red" },
    ];
    return { columns, actions, form, sections };
};
