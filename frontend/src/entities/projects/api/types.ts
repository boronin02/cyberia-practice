export interface ProjectResponse {
  message: "string";
  data: {
    pagination: {
      page: "string";
      per_page: "string";
      last_page: "string";
      total: "string";
    };
    items: ProjectResource[];
  };
}

export interface ProjectResource {
  id: number;
  title: string;
  description: string;
  image: {
    original_url: string;
    preview_url: string;
  };
}
