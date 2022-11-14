/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./resources/**/**/*.vue",
        "./resources/**/**/**/*.vue",
        './node_modules/@protonemedia/inertiajs-tables-laravel-query-builder/**/*.{js,vue}',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Noto Sans Arabic", "sans"],
                serif: ["Noto Sans Arabic", "sans-serif"],
                display: ["Noto Sans Arabic", "sans-serif"],
                body: ["Noto Sans Arabic", "sans-serif"],
            },
        },
    },
    safelist: [
        "bg-red-500",
        "bg-green-500",
        "bg-teal-500",
        "bg-yellow-500",
        "bg-indigo-500",
        "bg-zinc-500",
        "bg-blue-500",
        "bg-sky-500",
        "bg-slate-500",
        "bg-gray-500",
        "bg-orange-500",
        "text-3xl",
        "lg:text-4xl",
    ],
    plugins: [],
};
