<template>
    <modal name="new-project" classes="p-10 bg-card rounded-lg" height="auto">
        <h1 class="font-normal mb-16 text-center text-2xl">Let's Start Something New!</h1>
        <form @submit.prevent="submit">
            <div class="flex">
                <div class="flex-1 mr-4">
                    <div class="mb-4">
                        <label for="title" class="text-sm block mb-2">Title</label>
                        <input type="text" id="title"
                               class="border py-2 px-2 text-xs block w-full rounded"
                               :class="errors.title ? 'border-error' : 'border-muted-light'"
                               v-model="form.title">
                        <span class="text-xs italic text-error" v-if="errors.title"
                              v-text="errors.title[0]"></span>
                    </div>
                    <div class="mb-4">
                        <label for="description" class="text-sm block mb-2">Description</label>
                        <textarea id="description"
                                  class="border py-2 px-2 text-xs block w-full rounded"
                                  :class="errors.description ? 'border-error': 'border-muted-light'"
                                  rows="7" v-model="form.description"></textarea>
                        <span class="text-xs italic text-error" v-if="errors.description"
                              v-text="errors.description[0]"></span>
                    </div>
                </div>
                <div class="flex-1 ml-4">
                    <div class="mb-4">
                        <label class="text-sm block mb-2">Need Some Tasks?</label>
                        <input type="text"
                               class="border border-muted-light py-2 px-2 mb-2 text-xs block w-full rounded"
                               placeholder="Task 1" v-for="task in form.tasks" v-model="task.body">
                    </div>
                    <button type="button" class="inline-flex items-center text-xs  mb-4" @click="addTask">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <g fill="none" fill-rule="evenodd" opacity=".307">
                                <path fill="#000" d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373
                            12-12-5.373-12-12-12zm6 13h-5v5h-2v-5h-5v-2h5v-5h2v5h5v2z"></path>
                            </g>
                        </svg>
                        <span class="ml-2">Add New Task Field</span>
                    </button>
                </div>
            </div>
            <footer class="flex justify-end">
                <button type="button" class="button is-outlined mr-4" @click="$modal.hide('new-project')">Cancel</button>
                <button type="submit" class="button">Create Project</button>
            </footer>
        </form>
    </modal>
</template>
<script>
    export default {
        data() {
            return {
                form: {
                    title: '',
                    description: '',
                    tasks: [
                        {body: ''},
                    ]
                },
                errors: {}
            }
        },

        methods: {
            addTask() {
                this.form.tasks.push({value: ''})
            },
            submit() {
                axios.post('/projects', this.form)
                    .then(response => {
                        location = response.data.message;
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors;
                    });
            }
        }
    }
</script>