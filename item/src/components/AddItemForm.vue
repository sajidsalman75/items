<template>
  <v-container>
    <v-form v-model="valid" @submit.prevent.eager="saveItem">
      <v-text-field v-model="newItem.name" label="Name"></v-text-field>
      <v-text-field prefix="AED" :rules="priceRules" v-model.number="newItem.price" label="Price"
        required></v-text-field>
      <v-text-field v-model.number="newItem.quantity" :rules="quantityRules" label="Quantity" required></v-text-field>

      <v-spacer></v-spacer>
      <v-btn color="primary" type="submit">Save</v-btn>
    </v-form>
    <div v-if="itemResponse">
      <v-form v-for="(discount, index) in discounts" :key="index" v-model="discountValid"
        @submit.prevent.eager="saveDiscount(discount.percentage)">
        <v-card>
          <v-card-text>
            <v-text-field :rules="discountRules" v-model.number="discount.percentage" label="Discount Percentage"
              type="number" required></v-text-field>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary" type="submit">Save</v-btn>
            <v-btn icon small color="error" @click="removeDiscount(index)">
              <v-icon>mdi-delete</v-icon>
            </v-btn>
          </v-card-actions>
        </v-card>

        <v-btn fab small color="primary" @click="addDiscount">
          <v-icon>mdi-plus</v-icon>
        </v-btn>
      </v-form>
    </div>
  </v-container>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();

const newItem = ref({ name: '', price: 0, quantity: 0, discounts: [] });
const valid = ref(false);
const itemResponse = ref(null)
const discountValid = ref(false)
const apiUrl = import.meta.env.VITE_APP_API_URL;
const discounts = ref([]);

const priceRules = [
  v => v >= 1 || 'Price must be at least 1',
];

const quantityRules = [
  v => v >= 1 || 'Quantity must be at least 1',
];

const discountRules = [
  v => v >= 1 && v <= 100 || 'Discount must be between 1 and 100',
];

const addDiscount = () => {
  discounts.value.push({ percentage: 0 });
};

const removeDiscount = (index) => {
  newItem.value.discounts.splice(index, 1);
};

const saveDiscount = async (percentage) => {
  if (!valid.value) {
    return; // Prevent form submission if validation fails
  }
  // Implement logic to add item to data source (e.g., API call)
  try {
    const response = await fetch(`${apiUrl}/discounts`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(percentage),
    });
    if (response.ok) {

      // Handle successful creation (e.g., clear form, navigate back)
      // newItem.value = { name: '', price: 0, quantity: 0, discounts: [] };
      // router.push('/'); // Replace with path to list items
    } else {
      // Handle errors (e.g., display error message)
      console.error('Error creating item:', await response.text());
    }
  } catch (error) {
    console.error('Error creating item:', error);
  }
};

const saveItem = async () => {
  if (!valid.value) {
    return; // Prevent form submission if validation fails
  }
  // Implement logic to add item to data source (e.g., API call)
  try {
    const response = await fetch(`${apiUrl}/items`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(newItem.value),
    });
    if (response.ok) {
      itemResponse.value = response
      // Handle successful creation (e.g., clear form, navigate back)
      // newItem.value = { name: '', price: 0, quantity: 0, discounts: [] };
      // router.push('/'); // Replace with path to list items
    } else {
      // Handle errors (e.g., display error message)
      console.error('Error creating item:', await response.text());
    }
  } catch (error) {
    console.error('Error creating item:', error);
  }
};
</script>

<style scoped>
/* Add styling as needed */
</style>
