import { fetchProjects } from "@/entities/projects/api/projectsApi";
import { fetchReviews } from "@/entities/reviews/api/reviewsApi";
import { Home } from "@/view/home/ui";

export default async function Page() {
  let projectsData, reviewsData;

  try {
    [projectsData, reviewsData] = await Promise.all([fetchProjects(1), fetchReviews(1)]);
  } catch (error) {
    return <Home reviews={[]} />;
  }

  const reviews = reviewsData?.data?.items || [];
  const projects = projectsData?.data?.items || [];

  return <Home reviews={reviews} />;
}
