document.addEventListener('DOMContentLoaded', () => {

    const emailCheckRegex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/

    const app = document.querySelector('#app')

    if (app) {
        BX.Vue.create({
            el: app,
            data: {
                loading: false,

                validName: true,
                validEmail: true,
                validMsg: true,

                form: {
                    username: '',
                    email: '',
                    msg: ''
                },

                sendForm: false
            },

            computed: {
                notNumber() {
                    return !this.form.username.match(/\d/);
                },

                isValidName () {
                    return this.form.username.length < 1 || this.form.username.length > 2 && this.notNumber
                },

                isValidEmail () {
                    return this.form.email.length < 1 || emailCheckRegex.test(this.form.email)
                },

                isValidMsg () {
                    return this.form.msg.length < 1 || this.form.msg.length >= 10
                },

                isCompleteName () {
                    return this.form.username.length > 2
                },

                isCompleteEmail () {
                    return emailCheckRegex.test(this.form.email)
                },

                isCompleteMsg () {
                    return this.form.msg.length >= 10
                },

                msgLength() {
                    return 10 - this.form.msg.length
                }
            },

            mounted() {
                this.loading = true
            },

            methods: {
                validate() {
                    return this.form.username.length > 2 && this.form.msg.length >= 10 && emailCheckRegex.test(this.form.email) && this.notNumber
                },

                resetForm() {
                    this.sendForm = false
                    this.form.username = ''
                    this.form.email = ''
                    this.form.msg = ''
                },

                send() {
                    this.validName = this.form.username.length > 2
                    this.validEmail = emailCheckRegex.test(this.form.email)
                    this.validMsg = this.form.msg.length >= 10

                    if ( this.validate() ) {
                        this.sendForm = true
                        setTimeout(() => this.resetForm(), 3000)
                    }
                }
            }
        })
    }
});