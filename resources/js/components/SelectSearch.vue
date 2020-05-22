<template>
    <div class="dropdown" v-if="options" v-click-outside="hideOptions">

        <!-- Dropdown Input -->
        <input class="form-control"
               :class="classes"
               @focus="showOptions(true)"
               @keyup="keyMonitor"
               v-model="searchFilter"
               :disabled="disabled"
               :placeholder="placeholder"/>

        <div v-if="multiple">
            <span v-for="select in selected"
                  class="badge badge-secondary p-1 ml-1">{{select[keyOption]}}
                <span class="pointer" @click="removeTag(select)">&times;</span>
            </span>
        </div>

        <!-- Dropdown Menu -->
        <div class="dropdown-content" v-show="optionsShown">
            <div
                    class="dropdown-item"
                    @mousedown="selectOption(option)"
                    :class="{'selected':selectedItem(option)}"
                    v-for="(option, index) in filteredOptions"
                    :key="index">
                {{ option[keyOption] || option.id || '-' }}
            </div>
        </div>

        <input type="text" v-if="!multiple" :name="name" :value="selected[keyData]" hidden>
        <input type="text" v-if="multiple" :name="name+'[]'" v-for="select in selected" :value="select[keyData]" hidden>
    </div>
</template>

<script>
    import vClickOutside from 'v-click-outside'

    export default {
        name: "SelectSearch",
        props: {
            name: {
                type: String,
                required: false,
                default: 'dropdown',
                note: 'Input name'
            },
            options: {
                type: Array,
                required: true,
                default: [],
                note: 'Options of dropdown. An array of options with id and name',
            },
            placeholder: {
                type: String,
                required: false,
                default: 'Please select an option',
                note: 'Placeholder of dropdown'
            },
            disabled: {
                type: Boolean,
                required: false,
                default: false,
                note: 'Disable the dropdown'
            },
            maxItem: {
                type: Number,
                required: false,
                default: 6,
                note: 'Max items showing'
            },
            keyOption: {
                type: String,
                required: true,
                default: 'name',
                note: 'key of option for show in dropdown'
            },
            keyData: {
                type: String,
                required: true,
                default: 'id',
                note: 'key of option for send in backend'
            },
            classes: {
                type: String,
                required: false,
                default: '',
                note: 'class of input dropdown'
            },
            multiple: {
                type: Boolean,
                required: false,
                default: false,
                note: 'multiple select of dropdown'
            },
            chosen:{
                type: Array|Object,
                required: false,
                default: null,
                note: 'options chosen before',
            }
        },
        directives: {
            clickOutside: vClickOutside.directive
        },
        data() {
            return {
                selected: {},
                optionsShown: false,
                searchFilter: ''
            }
        },
        created() {
            this.defineTypeSelected();
        },
        computed: {
            filteredOptions() {
                const filtered = [];
                const regOption = new RegExp(this.searchFilter, 'ig');
                for (const option of this.options) {
                    if (option[this.keyOption].match(regOption)) {
                        if (filtered.length < this.maxItem) filtered.push(option);
                    }
                }
                return filtered;
            },
        },
        methods: {
            defineTypeSelected() {
                if (this.multiple) {
                    this.selected = this.chosen ?? [];
                } else {
                    this.selected = this.chosen ?? {};
                }
                this.$emit('selected', this.selected);
            },
            selectOption(option) {
                if (this.multiple) {
                    if (!this.selected.find(item => item.id == option.id))
                        this.selected.push(option);
                } else {
                    this.selected = option;
                    this.searchFilter = this.selected[this.keyOption];
                }
                this.$emit('selected', this.selected);
            },
            showOptions(bool) {
                if (!this.disabled) {
                    this.optionsShown = bool;
                }
            },
            // Selecting when pressing Enter
            keyMonitor(event) {
                if (event.key === "Enter" && this.filteredOptions[0])
                    this.selectOption(this.filteredOptions[0]);
            },
            selectedItem(option) {
                if (this.multiple && this.selected.find(item => item.id == option.id)) {
                    return true;
                }
                if (!this.multiple && this.selected.id == option.id) {
                    return true;
                }
            },
            hideOptions() {
                this.showOptions(false);
                this.$emit('selected', this.selected);
            },
            removeTag(select) {
                this.selected = this.selected.filter(function (obj) {
                    return obj.id !== select.id;
                });
                this.$emit('selected', this.selected);
            }
        },
        watch: {
            searchFilter(val) {
                this.$emit('filter', val);
            }
        }
    }
</script>

<style lang="scss" scoped>
    .dropdown {
        position: relative;
        display: block;
        margin: auto;

        .dropdown-input {
            background: #fff;
            cursor: pointer;
            border: 1px solid #e7ecf5;
            border-radius: 3px;
            color: #333;
            display: block;
            /*font-size: .8em;*/
            padding: 6px;
            min-width: 250px;
            max-width: 250px;

            &:hover {
                background: #f8f8fa;
            }
        }

        .dropdown-content {
            position: absolute;
            background-color: #fff;
            width: 100%;
            max-height: 248px;
            border: 1px solid #e7ecf5;
            box-shadow: 0px -8px 34px 0px rgba(0, 0, 0, 0.05);
            overflow: auto;
            z-index: 1;

            .dropdown-item {
                color: black;
                font-size: .9em;
                line-height: 1em;
                padding: 8px;
                text-decoration: none;
                display: block;
                cursor: pointer;

                &:hover {
                    background-color: #e7ecf5;
                }

                &.selected {
                    background-color: #ccc !important;
                }
            }
        }

        .dropdown:hover .dropdowncontent {
            display: block;
        }
    }
</style>