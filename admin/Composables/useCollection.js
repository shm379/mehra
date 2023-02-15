import { ref, isRef, unref, watchEffect } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";

export default () => {
    const form = useForm({
        title: null,
        description: null,
        is_active: null,
        cover_image: null,
        image: null,
        collection_type: null,
        items: {},
    }), sections = ref([
        {
            title: "مشخصات موضوع",
            anchor: "collection-components-info",
        },
        {
            title: "تصاویر",
            anchor: "collection-components-gallery",
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
        { title: "نمایش", route: "admin.collections.show", color: "blue" },
        { title: "ویرایش", route: "admin.collections.edit", color: "orange" },
        { title: "حذف", route: "admin.collections.destroy", color: "red" },
    ];
    return { columns, actions, form, sections };
};
