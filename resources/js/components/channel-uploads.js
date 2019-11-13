Vue.component('channel-uploads', {
    props: {
        channel: {
            type: Object,
            required: true,
            default: () => ({})
        }
    },
    data: () => ({
        selected: false,
        videos: [],
        progress: {}
    }),
    methods: {
        upload () {
            this.selected = true
            this.videos = Array.from(this.$refs.videos.files)

            const uloaders = this.videos.map(video => {
                const form = new FormData()
                this.progress[video.name] = 0

                form.append('video',video)
                form.append('title', video.name)

                return axios.post(`/channels/${this.channel.id}/videos`, form, {
                    onUploadProgress: (event) => {
                        this.progress[video.name] = Math.ceil((event.loaded / event.total) * 100 )
                        
                        //this is used to update the progess data in real time to get in the view
                        this.$forceUpdate()
                    }
                })
            })
        }
    }
})