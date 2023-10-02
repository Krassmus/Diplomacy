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
            el: '#diplomacy_edit_nation_units',
            data: {
                units: $('#diplomacy_edit_nation_units').data('units')
            },
            methods: {
                deleteUnit: function (province_id) {
                    for (let i in this.units) {
                        if (this.units[i].province_id === province_id) {
                            this.$delete(this.units, i);
                        }
                    }
                },
                addUnit: function () {
                    let exists = false;
                    for (let i in this.units) {
                        if (this.units[i].province_id === $('#add_unit_province').val()) {
                            exists = true;
                        }
                    }
                    if (!exists) {
                        this.units.push({
                            province_id: $('#add_unit_province').val(),
                            province_name: $('#add_unit_province > option:selected').data('province_name'),
                            province_longname: $('#add_unit_province > option:selected').data('province_longname'),
                            type: $('#add_unit_type').val(),
                            subarea: $('#add_unit_subarea').val()
                        });
                    }
                    $('#add_unit_subarea').val('');
                }
            },
            computed: {
                sortedUnits: function () {
                    return this.units.sort(function (a, b) { return a.province_name.localeCompare(b.province_name); })
                }
            }
        });

    });


});
