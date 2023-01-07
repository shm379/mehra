import { ref, isRef, unref, watchEffect, computed } from "vue";
import {usePage} from "@inertiajs/inertia-vue3";

export default (prepareFlag=false) => {
    const props = usePage().props.value
    const submitUrl = ref(route('admin.products.store'))
    const isUpdate = computed(() => props.product && props.product.id);
    const attributes = ref(props.attributes);
    const attributeFields = ref(props.attributeTypes);


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
        { title: "نمایش", route: "admin.products.show", color: "blue" },
        { title: "ویرایش", route: "admin.products.edit", color: "orange" },
        { title: "حذف", route: "admin.products.destroy", color: "red" },
    ];
    function defaultValue(key,defaultV=null,propsKey='product'){
        if(props && props[propsKey])
            return props[propsKey][key]
        return defaultV
    }

    const {form, onPrepare} = useForm({
        _method: isUpdate.value ? 'put' : 'post',
        structure: defaultValue('structure',1),
        type: defaultValue('type',1),
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
        excerpt: defaultValue('excerpt'),
        description: defaultValue('description'),
        attributes: defaultValue('attributes',{}),
        media: defaultValue('media',[])
    })

    if(prepareFlag)
        onPrepare(prepareForm)



    /**
     * elements that must be prepared before initializing form
     *
     */
    function prepareForm(){
        if(isUpdate.value){
            submitUrl.value = route('admin.products.update',props.product.id);
        }
        prepareBook()
        prepareAttributes()
    }

    function prepareBook(){
        if(form.structure===1){
            sections.value.push(
                {
                    title: "جوایز و افتخارات",
                    anchor: "book-form-award",
                },
                {
                    title: "خلاصه",
                    anchor: "book-form-summary",
                },
                {
                    title: "نقاط قوت",
                    anchor: "book-form-points",
                },
            )
            form.summary = defaultValue('summary')
            form.producer = defaultValue('producer',[])
            form.authors = defaultValue('authors',[])
            form.translators = defaultValue('translators',[])
            form.illustrators = defaultValue('illustrators',[])
            form.narrators = defaultValue('narrators',[])
            form.awards = defaultValue('awards',[])
            form.sounds = defaultValue('sounds',[])
        }
    }
    function prepareAttributes(){
        let attribute_ids = {}
        for(let attribute in attributes.value) {
            let attribute_id = attributes.value[attribute].id
            if(isUpdate.value){
                attribute_ids[attribute_id] = attributes.value[attribute]
                if(attribute_ids[attribute_id].children.length>0){
                    for(let child in attribute_ids[attribute_id].children){
                        attribute_ids[attribute_ids[attribute_id].children[child].id] = attribute_ids[attribute_id].children[child]
                    }
                }
                if(form.attributes[attribute_id]) {
                    let values = [];
                    if(attribute_ids[attribute_id].values.length<0) {
                        attribute_ids[attribute_id].values = []
                        for (let i in form.attributes[attribute_id]) {
                            attribute_ids[attribute_id].values.push({
                                id: form.attributes[attribute_id][i].id,
                                title: form.attributes[attribute_id][i].value
                            })
                        }
                    }
                }
            } else {
                attribute_ids[attribute_id] = []
                if(attributes.value[attribute].children.length>0){
                    for(let child in attributes.value[attribute].children){
                        let attribute_id = attributes.value[attribute].children[child].id
                        attribute_ids[attribute_id] = []

                    }
                }
            }
        }

        form.attributes = attribute_ids
    }

    return {
        columns,
        actions,
        form,
        sections,
        isUpdate,
        submitUrl
    };
};
