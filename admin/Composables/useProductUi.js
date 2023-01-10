import {ref} from "vue";

export default  function () {
    const sections = ref([
        {
            title: "مشخصات ",
            anchor: "product-form-info",
        },
        {
            title: "طبقه بندی",
            anchor: "product-form-category",
        },
        {
            title: "تصاویر",
            anchor: "product-form-gallery",
        },
        {
            title: "ویژگی‌ها",
            anchor: "product-form-attributes",
        },
    ])
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
        {title: "نمایش", route: "admin.products.show", color: "blue"},
        {title: "ویرایش", route: "admin.products.edit", color: "orange"},
        {title: "حذف", route: "admin.products.destroy", color: "red"},
    ];

    return { sections, columns, actions}
}
