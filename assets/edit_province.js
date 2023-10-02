STUDIP.dialogReady(() => {
    let loader = function () {
        if (typeof STUDIP.Vue !== "undefined") {
            return STUDIP.Vue.load();
        } else {
            //4.6: Vue is already loaded:
            return new Promise(function (resolve, reject) {
                resolve({
                    Vue: window.Vue,
                    createApp: function (options) {
                        console.log(new window.Vue(options));
                        return new window.Vue(options);
                    }
                });
            });
        }
    };

    loader().then(({Vue, createApp}) => {

        let ProvinceEditor = new Vue({
            el: '#diplomacy_edit_province_connections',
            data: {
                connections: $('#diplomacy_edit_province_connections').data('connections'),
                new_id_top: 1
            },
            methods: {
                deleteConnection: function (connection_id) {
                    for (let i in this.connections) {
                        if (this.connections[i].connection_id === connection_id) {
                            this.$delete(this.connections, i);
                        }
                    }
                },
                addConnection: function () {
                    let id = 'new_' + this.new_id_top;
                    this.new_id_top++;
                    this.connections.push({
                        connection_id: id,
                        province_id: $('#diplomacy_add_province').val(),
                        province_name: $('#diplomacy_add_province > option:selected').data('name'),
                        province_longname: $('#diplomacy_add_province > option:selected').data('longname'),
                        subarea: $('#diplomacy_add_province_subarea').val(),
                        type: $('#diplomacy_add_province_type').val(),
                        own_subarea: $('#diplomacy_add_own_subarea').val()
                    });
                    $('#diplomacy_add_province_subarea').val('');
                    $('#diplomacy_add_own_subarea').val('');
                }
            },
            computed: {
                sortedConnections: function () {
                    return this.connections.sort(function (a, b) { return a.province_name.localeCompare(b.province_name); })
                }
            }
        });

    });


});
