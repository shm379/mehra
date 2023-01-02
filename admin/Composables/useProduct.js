import { ref, isRef, unref, watchEffect } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";

export default (props=false) => {
    function defaultValue(key,defaultV=null,propsKey='product'){
        if(props && props[propsKey])
            return props[propsKey][key]
        return defaultV
    }
    const form = useForm({
        submit_url:route('admin.products.store'),
        is_update: false,
        _method: 'post',
        structure: defaultValue('structure'),
        type: defaultValue('type'),
        min_purchases_per_user: defaultValue('min_purchases_per_user'),
        max_purchases_per_user: defaultValue('max_purchases_per_user'),
        is_active: defaultValue('is_active'),
        is_available: defaultValue('is_available'),
        is_virtual: defaultValue('is_virtual'),
        in_stock_count: defaultValue('in_stock_count'),
        price: defaultValue('price'),
        sale_percent: defaultValue('sale_percent'),
        title: defaultValue('title'),
        sub_title: defaultValue('sub_title'),
        summary: defaultValue('summary'),
        excerpt: defaultValue('excerpt'),
        description: defaultValue('description'),
        producer: defaultValue('producer'),
        authors: defaultValue('authors',[]),
        translators: defaultValue('translators',[]),
        illustrators: defaultValue('illustrators',[]),
        narrators: defaultValue('narrators',[]),
        attributes:defaultValue('attributes',{}),
        awards: defaultValue('awards',[]),
        sounds: defaultValue('sounds',[]),
        media: defaultValue('media',[])
    }), sections = ref([
        {
            title: "مشخصات کتاب",
            anchor: "book-info",
        },
        {
            title: "طبقه بندی",
            anchor: "book-category",
        },
        {
            title: "تصاویر",
            anchor: "book-gallery",
        },
        {
            title: "ویژگی‌ها",
            anchor: "book-attributes",
        },
        {
            title: "جوایز و افتخارات",
            anchor: "book-award",
        },
        {
            title: "خلاصه",
            anchor: "book-summary",
        },
        {
            title: "نقاط قوت کتاب",
            anchor: "book-points",
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
            name: "sub_title",
            label: "زیر عنوان",
            field: "sub_title",
            sortable: false,
        },
        {
            name: "price",
            label: "قیمت",
            field: "price",
            sortable: false,
        },
        {
            name: "comments_count",
            label: "تعداد دیدگاه ها",
            field: "comments_count",
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
