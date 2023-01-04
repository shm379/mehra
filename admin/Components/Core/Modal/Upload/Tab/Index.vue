<template>
    <vs-tabs useShow v-bind="$attrs">
        <vs-tab label="نمایش فایلها">
            <div class="con-tab-ejemplo">
                <components-core-modal-upload-tab-browser @select="$emit('select', $event)" />
            </div>
        </vs-tab>
        <vs-tab label="بارگذاری">
            <div class="con-tab-ejemplo">
                <components-core-modal-upload-tab-uploader />
            </div>
        </vs-tab>
    </vs-tabs>
</template>
