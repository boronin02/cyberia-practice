export interface ReviewsResponse {
  message: string;
  data: {
    pagination: {
      page: 0;
      per_page: number;
      total: number;
      last_page: number;
    };
    items: ReviewsResource[];
  };
}

export interface ImageResource {
  original_url: string;
}

export interface ProjectResourse {
  title: string;
}

export interface ReviewsResource {
  title: string;
  id: number;
  fio: string;
  position: string;
  content: string;
  image: ImageResource;
  project: ProjectResourse;
}
