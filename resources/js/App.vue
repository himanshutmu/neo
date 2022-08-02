<template>
    <div class="flex justify-center mt-24">
            <h1>Hello App!</h1>
            <p>
                <!-- use the router-link component for navigation. -->
                <!-- specify the link by passing the `to` prop. -->
                <!-- `<router-link>` will render an `<a>` tag with the correct `href` attribute -->
                <router-link to="/neo-data">Get Neo Data</router-link>
            </p>
            <!-- route outlet -->
            <!-- component matched by the route will render here -->
            <router-view></router-view>
    </div>
</template>