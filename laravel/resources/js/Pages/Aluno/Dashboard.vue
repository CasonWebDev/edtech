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
                                        @click="openModalCadastrarMatricula()"
                                    >
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="fill-white w-3 h-3" viewBox="0 0 24 24">
                                                <path d="M24 10h-10v-10h-4v10h-10v4h10v10h4v-10h10z"/>
                                            </svg>
                                        </span>
                                        <span>
                                            Criar Matricula
                                        </span>
                                    </button>
                                </div>

                                <div v-if="$page.props.matriculas.data.length === 0" class="w-full px-4 py-2 flex items-center justify-center">
                                    <h2>Você não possui matriculas</h2>
                                </div>

                                <table v-if="$page.props.matriculas.data.length > 0" class="w-full text-md bg-white shadow-md rounded mb-4">
                                    <tbody>
                                    <tr class="border-b">
                                        <th class="text-left p-3 px-5">Aluno</th>
                                        <th class="text-left p-3 px-5">Curso</th>
                                        <th class="text-left p-3 px-5">Data de Admissao</th>
                                        <th class="text-left p-3 px-5">Ativo</th>
                                        <th></th>
                                    </tr>
                                    <tr
                                        class="border-b hover:bg-orange-100"
                                        :class="{'bg-gray-100': index % 2}"
                                        v-for="(matricula, index) in $page.props.matriculas.data"
                                        :key="matricula.id"
                                    >
                                        <td class="p-3 px-5">{{ matricula.aluno.nome }}</td>
                                        <td class="p-3 px-5">{{ matricula.curso.nome }}</td>
                                        <td class="p-3 px-5">{{ matricula.data_admissao }}</td>
                                        <td class="p-3 px-5">{{ matricula.ativo ? 'Sim' : 'Não' }}</td>
                                        <td class="p-3 px-5 flex justify-end">
                                            <button
                                                type="button"
                                                class="mr-3 text-sm bg-green-500 hover:bg-green-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline"
                                                @click="openModalEditarMatricula(matricula)"
                                            >
                                                Editar
                                            </button>
                                            <button
                                                type="button"
                                                class="text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline"
                                                @click="onDelete(matricula)"
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
                            <pagination :data="matriculas" />
                        </div>
                    </div>
                </div>
            </main>
        </div>

        <modal-cadastro-matricula ref="modal" />
        <modal-editar-matricula ref="edita" />

    </div>
</template>

<script>
import Pagination from '@/Components/Pagination'
import ModalCadastroMatricula from '@/Components/Admin/Matricula/ModalCadastroMatricula'
import ModalEditarMatricula from '@/Components/Admin/Matricula/ModalEditarMatricula'
import Menu from '@/Components/Aluno/Menu'
import Swal from 'sweetalert2'
import { Inertia } from '@inertiajs/inertia'

export default {
    components: {
        Menu,
        Pagination,
        ModalCadastroMatricula,
        ModalEditarMatricula
    },

    props: {
        auth: Object,
        flash: Object,
        csrf_token: String,
        matriculas: Object,
        cursos: Object,
        errors: Object,
    },

    computed: {
        shouldHidePagination() {
            return !this.matriculas.prev_page_url && !this.matriculas.next_page_url;
        },
    },

    methods: {
        async onDelete(data) {
            Swal.fire({
                title: 'Você tem certeza?',
                text: "A exclusão da matrícula é permanente",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, deletar!'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    let uri = this.route('aluno.deletar.matricula');
                    await this.deletarMatricula(data, uri, this.$page.props.matriculas.data[0].aluno.id)
                }
            })
        },

        openModalEditarMatricula(data) {
            this.$page.props.errors = {}
            this.$refs.edita.showModal(data)
        },

        openModalCadastrarMatricula() {
            let aluno = this.$page.props.matriculas.data[0].aluno
            this.$refs.modal.showModal(aluno, this.$page.props.cursos.data)
        }
    },

    setup(props) {
        const deletarMatricula = async (data, uri, aluno_id) => {
            await Inertia.delete(uri,
                {
                    data: {
                        id: data.id,
                        aluno_id: aluno_id,
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
                        Inertia.reload({only: ['matriculas']})
                    }
                }
            );
        }

        return { deletarMatricula }
    }
}
</script>
