const { fontFamily } = require("tailwindcss/defaultTheme");
const colors = require("tailwindcss/colors");

module.exports = {
    purge: [
        "./app/**/*.php",
        "./resources/**/*.html",
        "./resources/**/*.js",
        "./resources/**/*.jsx",
        "./resources/**/*.ts",
        "./resources/**/*.php",
        "./resources/**/*.vue"
    ],
    darkMode: "media", // or 'media' or 'class'
    theme: {
        extend: {
            fontFamily: {
                sans: ["Inter", ...fontFamily.sans],
                roboto: ["Roboto", ...fontFamily.sans]
            }
        }
    },
    variants: {
        extend: {}
    },
    plugins: [require("tailwind-nord")]
};
