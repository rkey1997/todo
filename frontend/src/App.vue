<template>
  <v-app>
    <Card/>
    <!-- <Step/> -->
  </v-app>
</template>

<script>
import Card from '@/components/Card'
import Step from '@/components/Step'


export default {
  name: "App",
  

  components: {
   
    Card,
    Step
    
  },
  
};
</script>
