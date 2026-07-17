import { Container } from "@/shared/ui/Container";
import { Awards } from "./components";
import { Hero } from "./components";
import { ProjectsList } from "@/widgets/Projects";
import { Banners } from "./components/Banners";
import { Reviews } from "./components/Reviews";
import { ReviewsResource } from "@/entities/reviews/api/types";

interface HomeProps {
  reviews: ReviewsResource[];
}

export const Home = ({ reviews }: HomeProps) => {
  return (
    <>
      <Container>
        <Hero />
        <Awards />
        <ProjectsList showLoadButton={true} style="home" />
        <Reviews reviews={reviews} />
        <Banners />
      </Container>
    </>
  );
};
