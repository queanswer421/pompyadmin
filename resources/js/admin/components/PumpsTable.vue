<template>
  <v-data-table
    :headers="headers"
    :items="pumps"
    sort-by="line"
    class="elevation-1"
    :footer-props="{itemsPerPageText: 'Wyników na stronie'}"

  >
    <template v-slot:top>
      <v-toolbar
        flat
      >
        <v-toolbar-title>Pompy ciepła</v-toolbar-title>
        <v-divider
          class="mx-4"
          inset
          vertical
        ></v-divider>
        <v-spacer></v-spacer>
        <v-dialog
          v-model="dialog"
          max-width="700px"
        >
          <template v-slot:activator="{ on, attrs }">
            <v-btn
              color="primary"
              dark
              class="mb-2"
              v-bind="attrs"
              v-on="on"
            >
              Dodaj pompę
            </v-btn>
          </template>
          <v-card>
            <v-card-title>
              <span class="text-h5">{{ formTitle }}</span>
            </v-card-title>

            <v-card-text>
              <v-container>
                <v-row>
                  <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                            <v-select
                              v-model="category"
                              :items="categories"
                              :rules="[v => !!v || 'Item is required']"
                              label="Producent"
                              required
                            ></v-select>
                  </v-col>          
                  <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                  <v-text-field
                      v-model="editedItem.line"
                      label="Linia"
                    ></v-text-field>
                </v-col>
                <v-row>
                  <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                  <v-text-field
                      v-model="editedItem.model"
                      label="Model"
                    ></v-text-field>
                  </v-col>          
                  <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                  <v-text-field
                      v-model="editedItem.power"
                      label="Moc pompy"
                    ></v-text-field>
                </v-col>

                </v-row>

                </v-row>
                <v-row>
                  <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                  <v-select
                              v-model="category"
                              :items="categories"
                              :rules="[v => !!v || 'Item is required']"
                              label="Kategoria pompy"
                              required
                            ></v-select>
                  </v-col>
                  <v-col cols="12"
                    sm="6"
                    md="4">
                    <v-select
                              v-model="category"
                              :items="categories"
                              :rules="[v => !!v || 'Item is required']"
                              label="Typ pompy"
                              required
                            ></v-select>
                  </v-col>
                </v-row>
<v-row>
  <v-col>
    <v-text-field type="number" step="0.1"
                      v-model="editedItem.t"
                      label="temp"
                    ></v-text-field>
  </v-col>
  <v-col>
    <v-text-field type="number"
                      v-model="editedItem.t"
                      label="temp"
                    ></v-text-field>
  </v-col>
  <v-col>
    <v-text-field type="number"
                      v-model="editedItem.t"
                      label="temp"
                    ></v-text-field>
  </v-col>
  <v-col>
    <v-text-field type="number"
                      v-model="editedItem.t"
                      label="temp"
                    ></v-text-field>
  </v-col>
  <v-col>
    <v-text-field type="number"
                      v-model="editedItem.t"
                      label="temp"
                    ></v-text-field>
  </v-col>
  <v-col>
    <v-text-field type="number"
                      v-model="editedItem.t"
                      label="temp"
                    ></v-text-field>
  </v-col>
  <v-col>
    <v-text-field type="number"
                      v-model="editedItem.t"
                      label="temp"
                    ></v-text-field>
  </v-col>
  <v-col>
    <v-text-field type="number"
                      v-model="editedItem.t"
                      label="temp"
                    ></v-text-field>
  </v-col>

</v-row>
                

                <v-row>
                  <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                    <v-text-field
                      v-model="editedItem.city"
                      label="Głosność"
                    ></v-text-field>
                  </v-col>
                  <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                    <v-text-field
                      v-model="editedItem.city"
                      label="Cena"
                    ></v-text-field>
                  </v-col>
                </v-row>
              </v-container>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                color="blue darken-1"
                text
                @click="close"
              >
                Cancel
              </v-btn>
              <v-btn
                color="blue darken-1"
                text
                @click="save"
              >
                Save
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
        <v-dialog v-model="dialogDelete" max-width="500px">
          <v-card>
            <v-card-title class="text-h5">Czy chcesz usunąć producenta?</v-card-title>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="closeDelete">Cancel</v-btn>
              <v-btn color="blue darken-1" text @click="deleteItemConfirm">OK</v-btn>
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
    </template>
    <!-- ############## -->
    <template v-slot:[`item.actions`]="{ item }">
    <!-- <template v-slot:item.actions="{ item }"> -->
      <v-icon
        small
        class="mr-2"
        @click="editItem(item)"
      >
        mdi-pencil
      </v-icon>
      <v-icon
        small
        @click="deleteItem(item)"
      >
        mdi-delete
      </v-icon>
    </template>
    <template v-slot:no-data>
      <v-btn
        color="primary"
        @click="initialize"
      >
        Reset
      </v-btn>
    </template>
  </v-data-table>
</template>

<script>
    export default {
      data: () => ({

      category: null,
      categories: [
        'Pro',
        'Standard',
        'Basic',
      ],
        dialog: false,
        dialogDelete: false,
        headers: [
          {
            text: 'Producent',
            align: 'start',
            sortable: false,
            value: 'producer.name',
          },
          { text: 'Linia', value: 'line' },
          { text: 'Model', value: 'model' },
          { text: 'Moc [kW]', editable: false, value: 'power' },
          { text: 'Typ [Split/Monoblok]', value: 'type', sortable: false },
          { text: 'Kategoria', value: 'category', sortable: false },
        ],
        pumps: [],
        editedIndex: -1,
        editedItem: {
          id: '',
          producer_id: '',
          line: '',
          model: '',
          power: '',
          type: '',
          category: '',

        },
        defaultItem: {
          producer_id: '',
          line: '',
          model: '',
          power: '',
          type: '',
          category: '',
        },
      }),
  
      computed: {
        formTitle () {
          return this.editedIndex === -1 ? 'Nowa pompa' : 'Edytuj pompę'
        },
      },
  
      watch: {
        dialog (val) {
          val || this.close()
        },
        dialogDelete (val) {
          val || this.closeDelete()
        },
      },
  
      created () {
        this.initialize()
      },
  
      methods: {
        async initialize(){
          try {
            let {data} = await this.axios.get('http://localhost:8000/api/pumps');
            console.log(data);
            this.pumps = data.data;
          } catch (e) {
            console.log(e)
          }
        },
        async addPump(){
        try {
          await this.axios.post('http://localhost:8000/api/pumps', 
            {
              "name": this.editedItem.name,
              "email": this.editedItem.email,
              "password": this.editedItem.password
            }
          )
          this.pumps.push(this.editedItem)
          this.close()
        } catch (e) {
          console.log(e)
        }
      },
        async editPump(){
        try {
          await this.axios.put('http://localhost:8000/api/pumps/'+this.editedItem.id, 
            {
              "name": this.editedItem.name,
              "email": this.editedItem.email,
              "password": this.editedItem.password
            }
          )
          Object.assign(this.pumps[this.editedIndex], this.editedItem)
          this.close()
        } catch (e) {
          console.log(e)
        }
      },
        editItem (item) {
          this.editedIndex = this.pumps.indexOf(item)
          this.editedItem = Object.assign({}, item)
          this.editedItem.id = item.id
          this.dialog = true
        },
  
        deleteItem (item) {
          this.editedIndex = this.pumps.indexOf(item)
          this.editedItem = Object.assign({}, item)
          this.editedItem.id = item.id
          this.dialogDelete = true
        },
  
        async deleteItemConfirm () {
          await this.axios.delete('http://localhost:8000/api/pumps/'+this.editedItem.id)
          this.pumps.splice(this.editedIndex, 1)
          this.closeDelete()
        },
  
        close () {
          this.dialog = false
          this.$nextTick(() => {
            this.editedItem = Object.assign({}, this.defaultItem)
            this.editedIndex = -1
          })
        },
  
        closeDelete () {
          this.dialogDelete = false
          this.$nextTick(() => {
            this.editedItem = Object.assign({}, this.defaultItem)
            this.editedIndex = -1
          })
        },
  
        save () {
          if (this.editedIndex > -1) {
            console.log(this.editedItem.id)
            this.editPump()
          } else {
            this.addPump()  
          }
        },
      },
    }
  </script>