<template>
    <Modal
        v-model="isShow"
        :close="closeModal"
    >
        <div class="modal">
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col my-2">
                <breeze-validation-errors class="mb-4" />

                <form @submit.prevent="submit">
                    <div class="-mx-3 md:flex mb-6">
                        <div class="md:w-1/2 px-3">
                            <breeze-label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
                                Nome
                            </breeze-label>
                            <breeze-input
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3"
                                id="grid-first-name"
                                type="text"
                                placeholder="Técnico em Segurança"
                                v-model="form.nome"
                                required autofocus
                            />
                        </div>
                        <div class="md:w-1/2 px-3">
                            <breeze-label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-date">
                                Data Início
                            </breeze-label>
                            <breeze-input
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3"
                                id="grid-date"
                                type="date"
                                v-model="form.data_inicio"
                                required autofocus
                            />
                        </div>
                    </div>
                    <div class="flex items-center justify-end">
                        <breeze-button
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Cadastrar
                        </breeze-button>
                    </div>
                </form>
            </div>
        </div>
    </Modal>
</template>

<script>
import { ref } from "vue";
import BreezeValidationErrors from '@/Components/ValidationErrors'
import BreezeInput from '@/Components/Input'
import BreezeLabel from '@/Components/Label'
import BreezeButton from '@/Components/Button'
import { createToast } from 'mosha-vue-toastify';
import 'mosha-vue-toastify/dist/style.css'

export default {

    components: {
        BreezeValidationErrors,
        BreezeInput,
        BreezeLabel,
        BreezeButton
    },

    data() {
        return {
            form: this.$inertia.form({
                nome: '',
                data_inicio: ''
            })
        }
    },

    methods: {
        submit() {
            this.form
                .transform(data => ({
                    ... data
                }))
                .post(this.route('admin.cadastrar.curso'), {
                    onSuccess: () => {
                        this.form.reset()
                        this.closeModal()
                        this.$inertia.reload({only: ['cursos']})
                        createToast({
                            title: this.$page.props.flash.message.title,
                            description: this.$page.props.flash.message.text
                        }, {
                            type: this.$page.props.flash.message.type
                        })
                    },
                })
        }
    },

    setup () {
        const isShow = ref(false)
        function showModal () {
            isShow.value = true
        }
        function closeModal () {
            isShow.value = false
        }
        return {
            isShow,
            showModal,
            closeModal
        }
    }
}
</script>
