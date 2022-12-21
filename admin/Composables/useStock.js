import { ref, isRef, unref, watchEffect } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";

export default () => {
    const form = useForm({
        title: "",
        type: "",
        priority: "",
        period: "",
        country_id:"",
        state_id:"",
        city_id:"",
        is_active:1,
    }), sections = ref([
        {
            title: "مشخصات ",
            anchor: "stock-form",
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
            name: "stocks_count",
            label: "تعداد محصولات",
            field: "stocks_count",
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
        { title: "نمایش", route: "admin.stocks.show", color: "blue" },
        { title: "ویرایش", route: "admin.stocks.edit", color: "orange" },
        { title: "حذف", route: "admin.stocks.destroy", color: "red" },
    ];
    return { columns, actions, form, sections };
};
