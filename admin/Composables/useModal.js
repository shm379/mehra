import {ref} from "vue";
import { useRemember } from '@inertiajs/inertia-vue3'
import { useStorage } from '@vueuse/core'

export default function() {
    // const modals = useState([])
    const modals = useStorage('___modals___', () => [], sessionStorage) // returns Ref<string>

    function modal(option) {
        console.log(option)
        modals.value.push(option)

    }

    function onClose(i) {
        delete modals.value[i]
    }

    return {
        modals, modal, onClose
    }
}
