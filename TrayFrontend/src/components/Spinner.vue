<template>
  <div class="spinner-overlay">
    <div class="spinner"></div>
  </div>
</template>

<style scoped lang="scss">
.spinner-overlay {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 1rem;
}

.spinner {
  width: 32px;
  height: 32px;
  border: 4px solid #ccc;
  border-top-color: #2d6cdf;
  border-radius: 50%;
  animation: spin 0.8s linear infinite;
}

@keyframes spin {
  to {
    transform: rotate(360deg);
  }
}
</style>
