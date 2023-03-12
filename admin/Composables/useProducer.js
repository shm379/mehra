import { ref, isRef, unref, watchEffect } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";

export default () => {
    const form = useForm({
        title: null,
        sub_title: null,
        description: null,
        is_active: 1,
        logo: null,
    }), sections = ref([
        {
            title: "مشخصات ناشر/برند/تولیدکننده",
            anchor: "producer-components-info",
        },
        {
            title: "تصاویر",
            anchor: "producer-components-gallery",
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
            label: "نام دسته",
            field: "title",
            sortable: true,
        },
        {
            name: "description",
            label: "توضیحات",
            field: "description",
            sortable: false,
        },
        {
            name: "slug",
            label: "نامک",
            field: "slug",
            sortable: false,
        },
        {
            name: "type",
            label: "نوع",
            field: "type",
            sortable: false,
        },
        {
            name: "user",
            label: "ساخته شده توسط",
            field: "user",
            sortable: false,
        },
        {
            name: "actions",
            label: "عملیات",
            type: "action",
        },
    ]);

    const actions = [
        { title: "نمایش", route: "admin.producers.show", color: "blue" },
        { title: "ویرایش", route: "admin.producers.edit", color: "orange" },
        { title: "حذف", route: "admin.producers.destroy", color: "red" },
    ];
    return { columns, actions, form, sections };
};
