<template>
  <div>
    <h3>Check exchange rates from GBP</h3>
    <p>Type a currency</p>

    <label for="currency"></label>
    <input id="currency" ref="currency" v-model="targetCurrency" name="currency" placeholder="Example: USD, AUD, JPY" type="text">
    <button @click="getExchangeRate(targetCurrency)">Get Exchange Rate</button>
    <span v-show="loading" class="loading">Loading...</span>
    <p v-if="exchangeRate">Your exchange rate is: <span class="exchange-rate">£1 = {{ exchangeRate }}</span></p>
  </div>
</template>

<script>
export default {
  data () {
    return {
      exchangeRate: '',
      loading: false,
      targetCurrency: '',
    }
  },
  methods: {
    getExchangeRate (currency) {
      this.loading = true

      axios.get('/api/currency/exchange/' + currency)
          .then(response => {
            this.exchangeRate = response.data.exchangeRate

            this.loading = false
            this.targetCurrency = ''
            this.$refs.currency.focus()
          })
    },
  },
  mounted () {
    this.$refs.currency.focus()
  },
}
</script>

<style scoped>
.loading {
  display: block;
  margin-top: 1rem;
}

.exchange-rate {
  font-weight: 600;
}
</style>