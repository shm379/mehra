import {usePage} from "@inertiajs/inertia-vue3";
import {computed, watch, ref} from "vue";
import useProductUi from "@/Composables/useProductUi";

export default (prepareFlag = false) => {
    const props = usePage().props.value
    const submitUrl = ref(route('admin.products.store'))
    const isUpdate = computed(() => props.product && props.product.id);
    const attributes = ref(props.attributes);

    const attributeFields = ref(props.attributeTypes);

    const { sections, columns,  actions } = useProductUi()

    function defaultValue(key, defaultV = null, propsKey = 'product') {
        if (props && props[propsKey])
            return props[propsKey][key]
        return defaultV
    }

    const {form, onPrepare} = useForm({
        _method: isUpdate.value ? 'put' : 'post',
        structure: defaultValue('structure', 1),
        type: defaultValue('type', 1),
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
        attributes: defaultValue('attributes', []),
        media: defaultValue('media', []),
    })

    watch(form, (n,o) => {
        console.log("FORM UPDATED" ,form)
    })


    if (prepareFlag)
        onPrepare(prepareForm)


    /**
     * elements that must be prepared before initializing form
     *
     */
    function prepareFormMeta(type) {
        form.type = type
        prepareForm()
        console.log("change type of book")

    }
    /**
     * elements that must be prepared before initializing form
     *
     */
    function prepareForm() {
        if (isUpdate.value) {
            submitUrl.value = route('admin.products.update', props.product.id);
        }
        prepareBook()
        prepareAttributes()
    }

    function prepareBook() {

        if (form.structure === 1) {
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
            form.producer = defaultValue('producer', [])
            form.authors = defaultValue('authors', [])
            form.translators = defaultValue('translators', [])
            form.illustrators = defaultValue('illustrators', [])
            form.narrators = defaultValue('narrators', [])
            form.awards = defaultValue('awards', [])
            form.sounds = defaultValue('sounds', [])
        } else {
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
            form.producer = defaultValue('producer', [])
            form.authors = defaultValue('authors', [])
            form.translators = defaultValue('translators', [])
            form.illustrators = defaultValue('illustrators', [])
            form.narrators = defaultValue('narrators', [])
            form.awards = defaultValue('awards', [])
            form.sounds = defaultValue('sounds', [])
        }

        if (form.type === 2) {
            if (sections.value.find(section => section.anchor === 'book-form-sounds')) {
                form.is_virtual = false;
                sections.value.splice(sections.value.findIndex(section => section.anchor === 'book-form-sounds'))
            } else {

                form.is_virtual = true;
                sections.value.push({title: 'فایل های صوتی', anchor: 'book-form-sounds'})

            }
        } else {
            if (sections.value.find(section => section.anchor === 'book-form-sounds')) {
                form.is_virtual = false;
                sections.value.splice(sections.value.findIndex(section => section.anchor === 'book-form-sounds'))
            }
        }
    }

    function prepareAttributes() {
        let attribute_ids = {}

        for (let attribute in attributes.value) {
            let attribute_id = attributes.value[attribute].id
            if (isUpdate.value) {

            } else {
                attribute_ids[attribute_id] = []
                if (attributes.value[attribute].children.length > 0) {
                    for (let child in attributes.value[attribute].children) {
                        let attribute_id = attributes.value[attribute].children[child].id
                        attribute_ids[attribute_id] = []
                    }
                }
            }
        }

        form.attributes = attribute_ids
    }

    return {
        prepareFormMeta,
        columns,
        actions,
        form,
        attributes,
        sections,
        isUpdate,
        submitUrl
    };
};
