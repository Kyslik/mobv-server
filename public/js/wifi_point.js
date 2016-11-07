// Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");


Vue.config.silent = false;

new Vue({

    el: '#manage-vue',

    data: {
        wifi_points: [],
        pagination: {
            total: 0,
            per_page: 2,
            from: 1,
            to: 0,
            current_page: 1
        },
        offset: 4,
        formErrors:{},
        formErrorsUpdate:{},
        newItem : {
            'ssid':'',
            'bssid':'',
            'capabilities':'',
            'level':'',
            'frequency':'',
            'timestamp':'',
            'distance':'',
            'distanceSd':''
        },
        fillItem : {
            'id':'',
            'ssid':'',
            'bssid':'',
            'capabilities':'',
            'level':'',
            'frequency':'',
            'timestamp':'',
            'distance':'',
            'distanceSd':''
        }
    },

    computed: {
        isActived: function () {
            return this.pagination.current_page;
        },
        pagesNumber: function () {
            if (!this.pagination.to) {
                return [];
            }
            var from = this.pagination.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }
            var to = from + (this.offset * 2);
            if (to >= this.pagination.last_page) {
                to = this.pagination.last_page;
            }
            var pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        }
    },

    ready : function(){
        this.getVueItems(this.pagination.current_page);
    },

    methods : {

        getVueItems: function(page){
            this.$http.get('/crud-wifi-points?page='+page).then((response) => {
                console.log(response);
                this.$set('wifi_points', response.data.data.data);
            this.$set('pagination', response.data.pagination);
        });
        },

        createItem: function(){
            var input = this.newItem;
            this.$http.post('/wifi-points',input).then((response) => {
                this.changePage(this.pagination.current_page);
            this.newItem = {
                'ssid':'',
                'bssid':'',
                'capabilities':'',
                'level':'',
                'frequency':'',
                'timestamp':'',
                'distance':'',
                'distanceSd':''
            };
            $("#create-wifi_point").modal('hide');
            toastr.success('Item Created Successfully.', 'Success Alert', {timeOut: 5000});
        }, (response) => {
                this.formErrors = response.data;
            });
        },

        deleteItem: function(wifi_point){
            this.$http.delete('/wifi-points/'+wifi_point.id).then((response) => {
                this.changePage(this.pagination.current_page);
            toastr.success('Item Deleted Successfully.', 'Success Alert', {timeOut: 5000});
        });
        },

        editItem: function(wifi_point){
            this.fillItem = wifi_point;
            $("#edit-wifi_point").modal('show');
        },

        updateItem: function(id){
            var input = this.fillItem;
            this.$http.put('/wifi-points/'+id,input).then((response) => {
                this.changePage(this.pagination.current_page);
            this.fillItem = {
                'id':'',
                'ssid':'',
                'bssid':'',
                'capabilities':'',
                'level':'',
                'frequency':'',
                'timestamp':'',
                'distance':'',
                'distanceSd':''
            };
            $("#edit-wifi_point").modal('hide');
            toastr.success('Item Updated Successfully.', 'Success Alert', {timeOut: 5000});
        }, (response) => {
                this.formErrorsUpdate = response.data;
            });
        },

        changePage: function (page) {
            this.pagination.current_page = page;
            this.getVueItems(page);
        }

    }

});