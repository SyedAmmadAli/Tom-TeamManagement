@extends('dashboard.layouts.master')

@section('main-content')

@section('page-title')
    Auto Enhance Image
@endsection

@section('page-name')
    Auto Enhance Image
@endsection

<div class="row">
    <div class="col-md-12">
        <div class="card p-4">
            <form id="upload-form">
                @csrf
                <input type="file" name="images" id="file-input" class="form-control mb-3" multiple required>
                <button type="submit" id="submit-button" class="btn btn-primary">Enhance Image</button>
            </form>

            <div id="image-container" class="mt-3"></div>
        </div>
    </div>
</div>

<script>
    const apiKey = @json($apikey);
</script>

<script type="module">
    import { v4 as uuidv4 } from "https://jspm.dev/uuid";

    const fileInput = document.getElementById("file-input");
    const imageContainer = document.getElementById("image-container");
    const submitButton = document.getElementById("submit-button");
    const form = document.getElementById("upload-form");

    async function handleImageUpload(file, container, apiKey, orderId) {
        try {
            const progressBar = container.querySelector('.progress-bar');
            const statusText = container.querySelector('.status-text');
            const spinner = container.querySelector('.spinner-border');

            // Create image record
            statusText.textContent = 'Creating image record...';
            const createResponse = await fetch("https://api.autoenhance.ai/v3/images/", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "x-api-key": apiKey,
                },
                body: JSON.stringify({
                    image_name: file.name,
                    contentType: file.type,
                    order_id: orderId,
                }),
            });

            if (!createResponse.ok) {
                throw new Error("Image creation failed");
            }

            const createData = await createResponse.json();
            const imageId = createData.image_id;
            progressBar.style.width = '33%';

            // Upload to S3
            statusText.textContent = 'Uploading to cloud storage...';
            const uploadResponse = await fetch(createData.s3PutObjectUrl, {
                method: "PUT",
                headers: {
                    "Content-Type": file.type,
                },
                body: file,
            });

            if (!uploadResponse.ok) {
                throw new Error("File upload failed");
            }
            progressBar.style.width = '66%';

            // Start processing status check
            statusText.textContent = 'Processing image...';
            const enhancedUrl = await pollProcessingStatus(imageId, apiKey, statusText);
            
            // Update UI when processing complete
            progressBar.style.width = '100%';
            statusText.textContent = 'Processing complete!';
            spinner.style.display = 'none';

            // Create image preview and download elements
            const imgCol = document.createElement('div');
            imgCol.className = 'col-md-4 mb-3';
            
            const card = document.createElement('div');
            card.className = 'card h-100';

            const img = document.createElement('img');
            img.src = enhancedUrl;
            img.className = 'card-img-top';
            img.style.objectFit = 'cover';
            img.style.height = '200px';

            const cardBody = document.createElement('div');
            cardBody.className = 'card-body d-flex flex-column';

            const previewBtn = document.createElement('a');
            previewBtn.href = enhancedUrl;
            previewBtn.target = '_blank';
            previewBtn.className = 'btn btn-info mb-2';
            previewBtn.textContent = 'Preview';

            const downloadBtn = document.createElement('a');
            downloadBtn.href = enhancedUrl;
            downloadBtn.download = file.name;
            downloadBtn.className = 'btn btn-success';
            downloadBtn.textContent = 'Download';

            cardBody.appendChild(previewBtn);
            cardBody.appendChild(downloadBtn);
            card.appendChild(img);
            card.appendChild(cardBody);
            imgCol.appendChild(card);

            // Replace processing UI with result
            container.innerHTML = '';
            container.appendChild(imgCol);

        } catch (error) {
            container.innerHTML = `
                <div class="alert alert-danger mt-2">
                    Error processing ${file.name}: ${error.message}
                </div>
            `;
        }
    }

    async function pollProcessingStatus(imageId, apiKey, statusElement) {
        return new Promise(async (resolve, reject) => {
            const maxAttempts = 60; // 60 attempts (1 minute)
            let attempts = 0;

            const checkStatus = async () => {
                try {
                    attempts++;
                    const response = await fetch(`https://api.autoenhance.ai/v3/images/${imageId}`, {
                        headers: {
                            "x-api-key": apiKey,
                        },
                    });

                    if (!response.ok) throw new Error('Status check failed');
                    
                    const data = await response.json();

                    console.log(data);
                    
                    statusElement.textContent = `Processing status: ${data.status} (attempt ${attempts}/${maxAttempts})`;

                    if (data.status === 'processed') {
                        const enhancedRes = await fetch(`https://api.autoenhance.ai/v3/images/${imageId}/enhanced`, {
                            headers: {
                                "x-api-key": apiKey,
                            },
                        });
                        const enhancedData = await enhancedRes.json();
                        resolve(enhancedData.url);
                    } else if (data.status === 'failed') {
                        reject(new Error('Image processing failed'));
                    } else if (attempts >= maxAttempts) {
                        reject(new Error('Processing timeout'));
                    } else {
                        setTimeout(checkStatus, 1000); // Check every second
                    }
                } catch (error) {
                    reject(error);
                }
            };

            checkStatus();
        });
    }

    form.addEventListener("submit", async (e) => {
        e.preventDefault();
        const files = fileInput.files;
        if (!files.length || !apiKey) return;

        submitButton.disabled = true;
        submitButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...';

        const orderId = uuidv4();
        imageContainer.innerHTML = '';

        // Create processing cards for each file
        Array.from(files).forEach(file => {
            const container = document.createElement('div');
            container.className = 'processing-item mb-3 p-3 border rounded';
            container.innerHTML = `
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <strong>${file.name}</strong>
                    <div class="spinner-border spinner-border-sm text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <div class="progress">
                    <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 0%"></div>
                </div>
                <small class="status-text text-muted mt-1 d-block">Initializing...</small>
            `;
            imageContainer.appendChild(container);
            handleImageUpload(file, container, apiKey, orderId);
        });

        submitButton.disabled = false;
        submitButton.textContent = 'Enhance Image';
    });
</script>

@endsection