plugins {
    alias(libs.plugins.android.application)
}

android {
    namespace = "com.example.teacher_scheduler"
    compileSdk = 36

    defaultConfig {
        applicationId = "com.example.teacher_scheduler"
        minSdk = 28
        targetSdk = 36
        versionCode = 1
        versionName = "1.0"

        testInstrumentationRunner = "androidx.test.runner.AndroidJUnitRunner"
    }

    buildTypes {
        release {
            isMinifyEnabled = false
            proguardFiles(
                getDefaultProguardFile("proguard-android-optimize.txt"),
                "proguard-rules.pro"
            )
        }
    }
    compileOptions {
        sourceCompatibility = JavaVersion.VERSION_11
        targetCompatibility = JavaVersion.VERSION_11
    }
    buildFeatures {
        viewBinding = true
    }
}

dependencies {
    implementation("com.android.volley:volley:1.2.1")
    implementation("androidx.appcompat:appcompat:1.7.0")
    implementation("com.google.android.material:material:1.11.0")
    implementation("androidx.constraintlayout:constraintlayout:2.1.4")
    implementation("com.android.volley:volley:1.2.1")
    // material, recyclerview, viewpager2
    implementation("com.google.android.material:material:1.8.0")
    implementation("androidx.recyclerview:recyclerview:1.3.0")
    implementation("androidx.viewpager2:viewpager2:1.1.0-beta01")
// hoặc 1.0.0 nếu muốn ổn định
    implementation(libs.appcompat)
    implementation(libs.material)
    implementation(libs.activity)
    implementation(libs.constraintlayout)
    implementation(libs.annotation)
    implementation(libs.lifecycle.livedata.ktx)
    implementation(libs.lifecycle.viewmodel.ktx)
    testImplementation(libs.junit)
    androidTestImplementation(libs.ext.junit)
    androidTestImplementation(libs.espresso.core)
}