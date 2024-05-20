<template>
  <v-container>
    <v-btn fab color="primary" :to="'/add'">
      <v-icon>mdi-plus</v-icon>
    </v-btn>
    <v-row>
      <v-col v-for="item in items" :key="item.id" cols="4">
        <div class="d-flex flex-column justify-center">
          <div class="d-flex justify-center">
            {{ item.name }}<br />
            AED {{ item.price }} <br />
            Quantity: {{ item.quantity }} <br />
            Discounts
            <ul>
              <li v-for="discount in item.discounts" :key="discount">{{ discount }}</li>
            </ul>
          </div>
          <div class="d-flex justify-center mt-5">
            <v-btn icon small :to="'/edit/' + item.id">
              <v-icon>mdi-pencil</v-icon>
            </v-btn>
            <v-btn icon small color="error" @click="deleteItem(item)">
              <v-icon>mdi-delete</v-icon>
            </v-btn>
          </div>
        </div>
      </v-col>
    </v-row>
  </v-container>
</template>

<script setup>
import { ref, onMounted } from "vue";

const items = ref([]);
const apiUrl = import.meta.env.VITE_APP_API_URL;

const fetchData = async () => {
  try {
    const response = await fetch(`${apiUrl}/items`);
    if (response.ok) {
      items.value = await response.json();
    } else {
      console.error('Error fetching items:', await response.text());
    }
  } catch (error) {
    console.error('Error fetching items:', error);
  }
};

onMounted(fetchData);

const deleteItem = async (item) => {
  try {
    const response = await fetch(`${apiUrl}/items/${item.id}`, {
      method: 'DELETE',
    });
    if (response.ok) {
      // Item deleted successfully, update local state
      const index = items.value.findIndex(i => i.id === item.id);
      items.value.splice(index, 1);
    } else {
      console.error('Error deleting item:', await response.text());
      // Handle errors (e.g., display error message)
    }
  } catch (error) {
    console.error('Error deleting item:', error);
    // Handle errors (e.g., display error message)
  }
};
</script>
