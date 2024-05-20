<template>
  <v-container>
    <v-form v-model="valid" @submit.prevent="saveItem">
      <v-text-field v-model="editedItem.name" label="Name" required></v-text-field>
      <v-text-field v-model.number="editedItem.price" label="Price" required></v-text-field>
      <v-text-field v-model.number="editedItem.quantity" label="Quantity" required></v-text-field>
      <v-spacer></v-spacer>
      <v-btn color="primary" type="submit">Save</v-btn>
    </v-form>
  </v-container>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRouter, useRoute } from 'vue-router';

const router = useRouter();
const route = useRoute();

const editedItem = ref({});
const valid = ref(false);
const apiUrl = import.meta.env.VITE_APP_API_URL;

const fetchData = async () => {
  try {
    const response = await fetch(`${apiUrl}/items/${route.params.id}`);
    if (response.ok) {
      editedItem.value = await response.json();
    } else {
      console.error('Error fetching item:', await response.text());
      // Handle error (e.g., navigate back to list)
      router.push('/'); // Replace with path to list items
    }
  } catch (error) {
    console.error('Error fetching item:', error);
    // Handle error (e.g., navigate back to list)
    router.push('/'); // Replace with path to list items
  }
};

onMounted(fetchData)

const saveItem = async () => {
  // Implement logic to update item in data source (e.g., API call)
  try {
    const response = await fetch(`${apiUrl}/items/${editedItem.value.id}`, {
      method: 'PUT',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(editedItem.value),
    });
    if (response.ok) {
      // Handle successful update (e.g., display success message, navigate back)
      router.push('/'); // Replace with path to list items
    } else {
      // Handle errors (e.g., display error message)

    }
  }
  catch (e) {
    console.log(e);
  }
}
</script>