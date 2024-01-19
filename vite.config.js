import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import * as path from "path";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/scss/app.scss", "resources/js/app.js"],
            refresh: true,
        }),
    ],
    // Add resolve object and aliases
    resolve: {
        alias: {
            "~bootstrap": path.resolve(__dirname, "node_modules/bootstrap"),
            "~@fortawesome": path.resolve(
                __dirname,
                "node_modules/@fortawesome"
            ),
            "~resources": "/resources/",
        },
    },
});
