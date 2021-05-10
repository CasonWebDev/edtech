<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <Menu />

            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="bg-white rounded my-1">
                                <div class="w-full px-4 py-2 flex items-center justify-end">
                                    <button
                                        class="bg-green-500 px-4 py-2 text-xs font-semibold tracking-wider text-white inline-flex items-center space-x-2 rounded hover:bg-green-600"
                                        @click="$refs.modal.showModal()"
                                    >
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="fill-white w-3 h-3" viewBox="0 0 24 24">
                                                <path d="M24 10h-10v-10h-4v10h-10v4h10v10h4v-10h10z"/>
                                            </svg>
                                        </span>
                                        <span>
                                            Adicionar Aluno
                                        </span>
                                    </button>
                                </div>

                                <div v-if="$page.props.alunos.data.length === 0" class="w-full px-4 py-2 flex items-center justify-center">
                                    <h2>Nenhum aluno cadastrado</h2>
                                </div>

                                <table v-if="$page.props.alunos.data.length > 0" class="w-full text-md bg-white shadow-md rounded mb-4">
                                    <tbody>
                                        <tr class="border-b">
                                            <th class="text-left p-3 px-5">Nome</th>
                                            <th class="text-left p-3 px-5">E-mail</th>
                                            <th></th>
                                        </tr>
                                        <tr
                                            class="border-b hover:bg-orange-100"
                                            :class="{'bg-gray-100': index % 2}"
                                            v-for="(aluno, index) in $page.props.alunos.data"
                                            :key="aluno.id"
                                        >
                                            <td class="p-3 px-5">{{ aluno.nome }}</td>
                                            <td class="p-3 px-5">{{ aluno.email }}</td>
                                            <td class="p-3 px-5 flex justify-end">
                                                <inertia-link
                                                    type="button"
                                                    class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline"
                                                    :href="route('admin.matriculas', aluno.id)"
                                                >
                                                    Matriculas
                                                </inertia-link>
                                                <button
                                                    type="button"
                                                    class="mr-3 text-sm bg-green-500 hover:bg-green-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline"
                                                    @click="openModalEditarAluno(aluno)"
                                                >
                                                    Editar
                                                </button>
                                                <button
                                                    type="button"
                                                    class="text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline"
                                                    :class="{'disabled:opacity-50': aluno.matriculas.length > 0}"
                                                    :disabled="aluno.matriculas.length > 0"
                                                    @click="onDelete(aluno)"
                                                >
                                                    Deletar
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div v-if="!shouldHidePagination" class="px-6 pb-4">
                            <pagination :data="alunos" />
                        </div>
                    </div>
                </div>
            </main>
        </div>

        <modal-cadastro-aluno ref="modal"/>
        <modal-editar-aluno ref="edita" />

    </div>
</template>

<script>
import Pagination from '@/Components/Pagination'
import ModalCadastroAluno from '@/Components/Admin/Aluno/ModalCadastroAluno'
import ModalEditarAluno from '@/Components/Admin/Aluno/ModalEditarAluno'
import Menu from '@/Components/Admin/Menu'
import Swal from 'sweetalert2'
import { Inertia } from '@inertiajs/inertia'

export default {
    components: {
        Menu,
        Pagination,
        ModalCadastroAluno,
        ModalEditarAluno
    },

    props: {
        auth: Object,
        flash: Object,
        csrf_token: String,
        alunos: Object,
        errors: Object,
    },

    computed: {
        shouldHidePagination() {
            return !this.alunos.prev_page_url && !this.alunos.next_page_url;
        },
    },


    methods: {
        async onDelete(data) {
            Swal.fire({
                title: 'Você tem certeza?',
                text: "A exclusão do aluno é permanente",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, deletar!'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    let uri = this.route('admin.deletar.aluno');
                    await this.deletarAluno(data, uri)
                }
            })
        },

        openModalEditarAluno(data) {
            this.$page.props.errors = {}
            this.$refs.edita.showModal(data)
        }
    },

    setup(props) {
        const deletarAluno = async (data, uri) => {
            await Inertia.delete(uri,
                {
                    data: {
                        id: data.id,
                        _token: props.csrf_token
                    },
                    onFinish: () => {
                        if (props.flash.message) {
                            Swal.fire(
                                props.flash.message.title,
                                props.flash.message.text,
                                props.flash.message.type
                            )
                        }
                        Inertia.reload({only: ['alunos']})
                    }
                }
            );
        }

        return { deletarAluno }
    }
}
</script>
