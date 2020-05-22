<script>

    import ColumnNotFoundException from "../exceptions/ColumnNotFoundException";
    import DataTableButton from './DataTableButton.vue';

    export default {
        props: {
            comps: {
                type: Array,
                default: () => ([]),
            },
            meta: {
                type: Object,
                default: () => ({}),
            },
            name: {
                type: String,
                default: '',
            },
            value: {
                type: Object,
                default: () => ({}),
            },
            index: {
                type: Number,
                default: () => (0),
            },
            cellCheck: {
                type: Array, default: () => {
                    []
                }
            }
        },
        components: {DataTableButton},
        data() {
            return {};
        },
        render(createElement) {

            if (this.comps.length) {
                return createElement('div', this.comps.map((comp) => {
                    let props = {
                        name: comp.name,
                        data: this.value,
                        meta: this.meta,
                        href: comp.href,
                        method: comp.method,
                        handler: comp.handler,
                        modalComponent: comp.modalComponent,
                        access: comp.access,
                        classes: comp.classes
                    };

                    return createElement(comp.component ?? 'DataTableButton', {
                        props,
                    });
                }));
            }

            let columnName;

            if (this.name.split(".").length > 1) {
                columnName = this.value;
                columnName = eval('columnName.' + this.name)
            } else {
                if (this.name == 'iteration')
                    columnName = this.index+1;
                else
                    columnName = this.value[this.name];
            }

            if (typeof columnName === 'undefined' && !this.comps.length && columnName) {
                throw new ColumnNotFoundException(`The column ${this.name} was not found`);
            }
            let property = {};
            if (this.cellCheck) {
                this.cellCheck.map((cell) => {
                    if (cell.regex && eval(cell.regex).test(columnName)) {
                        Object.assign(property, cell.property);
                    }
                    if (cell.name && cell.name == this.name) {
                        Object.assign(property, cell.property);
                    }
                });
            }
            return createElement('span', property, columnName);
        },
    }
</script>
