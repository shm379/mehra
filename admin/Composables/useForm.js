import {ref, isRef, unref, watchEffect, computed} from "vue";
import {useForm, usePage} from "@inertiajs/inertia-vue3";

export default (formObj) => {
    const form = useForm(formObj)

    /**
     * to prepare form for mode edit
     *
     * @param callBackFunc      function name that is used to
     *                          prepare form for edit mode
     */
    function onPrepare(callBackFunc) {
        callBackFunc()
    }



    return {
        form,
        onPrepare,
    }
};
