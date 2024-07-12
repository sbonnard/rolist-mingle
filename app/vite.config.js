import { defineConfig } from 'vite';

export default defineConfig({
    build: {
        manifest: true,
        outDir: 'assets',
        rollupOptions: {
          input: '/js/script.js', // par exemple: 'src/main.js'
        },
    },


})