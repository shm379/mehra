import { ref, isRef, unref, watchEffect } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";

export default () => {
    const form = useForm({
        _method:"put",
        shipping_status: "",
        status: "",
        items: [],
        address: {},
        user: {},
        notes: [],
    }), sections = ref([
        [
            {
                title: "مشخصات ",
                anchor: "order-info",
                options: {},
                wide: true
            },
            {
                title: "وضعیت سفارش",
                anchor: "order-status",
            },
        ],
        [
            {
                title: "سفارشات",
                anchor: "order-items",
                full: true
            },
        ],
        [
            {
                title: "گزارشات",
                anchor: "order-notes",
                full: true
            },
        ]
    ]), columns = ref( [
        {
            name: "id",
            label: "شماره ردیف",
            field: "id",
            sortable: true,
        },
        {
            name: "discount",
            label: "تخفیف",
            field: "discount",
            sortable: true,
        },
        {
            name: "total_price",
            label: "قیمت کل",
            field: "total_price",
            sortable: false,
        },
        {
            name: "total_price_without_discount",
            label: "قیمت کل (بدون تخفیف)",
            field: "total_price_without_discount",
            sortable: false,
        },
        {
            name: "status",
            label: "وضعیت",
            field: "status",
            sortable: false,
        },
        {
            name: "items",
            label: "محصولات",
            field: "items",
            sortable: false,
        },
        {
            name: "notes",
            label: "یادداشت ها",
            field: "notes",
            sortable: false,
        },
        {
            name: "actions",
            label: "عملیات",
            type: "action",
        },
    ]);

    const actions = [
        { title: "نمایش", route: "admin.orders.show", color: "blue" },
        { title: "ویرایش", route: "admin.orders.edit", color: "orange" },
        { title: "حذف", route: "admin.orders.destroy", color: "red" },
    ];
    return { columns, actions, form, sections };
};
